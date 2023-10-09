<?php

namespace App\Services;

use App\Dto\Match\MatchInfoDto;
use App\Dto\Match\PlayerDto;
use App\Dto\MatchDetails\History\HistoryDto;
use App\Dto\MatchDetails\History\HistoryBlockItemDto;
use App\Dto\MatchDetails\History\TeamDto;
use App\Dto\MatchDetails\TournamentDto;
use App\Dto\MatchGame\PlayerDto as MatchGamePlayerDto;
use App\Dto\MatchDetails\PlayerDto as MatchDetailsPlayerDto;
use App\Dto\MatchDetails\TeamDto as MatchDetailsTeamDto;
use App\Dto\MatchDetails\MatchDto;
use App\Dto\MatchGame\MatchDataDto;
use App\Dto\MatchList\MatchTitleDto;
use App\Enums\GameEnum;
use App\Enums\GamesType;
use App\Models\GtMatchList;
use App\Services\Events\EventService;
use Carbon\Carbon;
use Dmp\Services\SearchServices\SearchService;
use http\Env\Request;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MatchService
{
    public const MATCH_HISTORY_COUNT = 10;
    public const DISCIPLINES = [313, 582];

    private function getTeamMatchHistoryQuery(int $teamId, ?int $team2Id = null): Builder
    {
        return DB::table('gt_match_list')
            ->select([
                'gt_match.id',
                'gt_match.t1s',
                'gt_match.t2s',
                'gt_match.bo',
                'gt_match.info',
                'gt_match_list.t1',
                'gt_match_list.t2',
                'gt_match_list.date',
                'gt_match_list.title',
                'gt_match_list.tid',
            ])
            ->join('gt_match', 'gt_match.id', '=', 'gt_match_list.id')
//            ->where('gt_match_list.id', '<>', $matchId) // exclude current match
            ->where('gt_match_list.is_current', '2')
            ->when(
                $team2Id,
                function (Builder $query) use ($teamId, $team2Id) {
                    return $query->where(function (Builder $query) use ($teamId, $team2Id) {
                        return $query->where('gt_match_list.t1', $teamId)
                            ->where('gt_match_list.t2', $team2Id);
                    })->orWhere(function (Builder $query) use ($teamId, $team2Id) {
                        return $query->where('gt_match_list.t1', $team2Id)
                            ->where('gt_match_list.t2', $teamId);
                    });
                },
                function (Builder $query) use ($teamId) {
                    return $query->where(fn(Builder $query) => $query
                        ->where('gt_match_list.t1', $teamId)
                        ->orWhere('gt_match_list.t2', $teamId)
                    );
                },
            )
            ->orderByDesc('gt_match_list.date');
    }

    private function historyBlock($row, ?int $priorityTeam): HistoryBlockItemDto
    {
        $title = MatchTitleDto::fromJson($row->title);
        $info = MatchInfoDto::fromJson($row->info);

        $block = new HistoryBlockItemDto($priorityTeam);
        $block->setMatchId($row->id);
        $block->setTournamentId($row->tid);
        $block->setTournamentTitle($title->tournamentTitle);
        $block->setBestOf($row->bo);
        $block->setDate($row->date);
        $block->setLogo($title->tournamentIcon);
        $block->setTeams(
            new TeamDto(
                $row->t1,
                $row->t1s,
                $info->team1->name,
                $info->team1->shortName,
                $info->team1->hasLogo(),
            ),
            new TeamDto(
                $row->t2,
                $row->t2s,
                $info->team2->name,
                $info->team2->shortName,
                $info->team2->hasLogo(),
            )
        );

        return $block;
    }

    public function getHistory(int $id, ?string $side = null): HistoryDto|Paginator
    {
        /** @var object $match */
        $match = DB::table('gt_match_list')
            ->select(['t1', 't2', 'game_id', 'title'])
            ->find($id);

        if ($side) {
            if ($side === 't2') {
                [$teamId, $team2Id] = [$match->t2, null];
            } else {
                [$teamId, $team2Id] = [$match->t1, $side === 't1' ? null : $match->t2];
            }

            $blockItems = $this->getTeamMatchHistoryQuery($teamId, $team2Id)
                ->paginate(static::MATCH_HISTORY_COUNT);

            $blockItems->getCollection()
                ->transform(fn ($row) => $this->historyBlock($row, $teamId));

            return $blockItems;
        }

        $block1Items = $this->getTeamMatchHistoryQuery($match->t1)
            ->limit(static::MATCH_HISTORY_COUNT + 1)
            ->get()
            ->map(fn ($row) => $this->historyBlock($row, $match->t1));

        $block2Items = $this->getTeamMatchHistoryQuery($match->t2)
            ->limit(static::MATCH_HISTORY_COUNT + 1)
            ->get()
            ->map(fn ($row) => $this->historyBlock($row, $match->t2));

        $block3Items = $this->getTeamMatchHistoryQuery($match->t1, $match->t2)
            ->limit(static::MATCH_HISTORY_COUNT + 1)
            ->get()
            ->map(fn ($row) => $this->historyBlock($row, null));

        return new HistoryDto(
            $match->t1,
            $match->t2,
            MatchTitleDto::fromJson($match->title),
            $block1Items,
            $block2Items,
            $block3Items
        );
    }

    public function getList(array $filter = []): Paginator
    {
        return GtMatchList::query()
            ->select([
                'gt_match_list.id',
                'gt_match_list.game_id',
                'gt_match_list.title',
                'gt_match_list.date',
                'gt_match_list.t1',
                'gt_match_list.t2',
                'gt_tournaments.id as tournament_id',
                'gt_tournaments.eng as tournament_eng',
                'gt_tournaments.title as tournament_title',
                'gt_tournaments.icon as tournament_icon',
                'gt_match.bo',
                'gt_match.info',
                'gt_match.t1s',
                'gt_match.t2s',
            ])
            ->whereIn('gt_match_list.game_id', static::DISCIPLINES)
            ->whereBetween('gt_match_list.date', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()->addDays(3)
            ])
            ->where('gt_match_list.is_current', '1')
            ->join('gt_tournaments', function (JoinClause $query) {
                return $query->on('gt_tournaments.id', '=', 'gt_match_list.tid');
            })
            ->join('gt_match', function (JoinClause $query) {
                return $query->on('gt_match.id', '=', 'gt_match_list.id');
            })
            ->when($filter['event_id'] || $filter['event_eng'], function (Builder $query) use ($filter) {
                return $query->when($filter['event_id'], function (Builder $query, $eventId) {
                    return $query->where('gt_tournaments.id', $eventId);
                })->when($filter['event_eng'] && !$filter['event_id'], function (Builder $query) use ($filter) {
                    return $query->where('gt_tournaments.eng', $filter['event_eng']);
                });
            })
            ->when($filter['game_id'], function (Builder $query, $gameId) {
                return $query->where('gt_match_list.game_id', $gameId);
            })
            ->when($filter['team_id'] || $filter['team_eng'], function (Builder $query) use ($filter) {
                /** @var $query \Illuminate\Contracts\Database\Eloquent\Builder */
                return $query->whereHas('team', function (Builder $query) use ($filter) {
                    return $query->when($filter['team_id'], function (Builder $query, $teamId) {
                        return $query->where('gt_match_teams.tid', $teamId);
                    })->when($filter['team_eng'] && !$filter['team_id'], function (Builder $query) use ($filter) {
                        return $query->join('gt_teams_list', function (JoinClause $query) use ($filter) {
                            return $query->on('gt_teams_list.id', '=', 'gt_match_teams.tid')
                                ->where('gt_teams_list.eng', $filter['team_eng']);
                        });
                    });
                });
            })
            ->with([
                'matchGames' => function (Builder $query) {
                    // TODO restrict by max num
                    return $query->select(['mid', 'num', 'match_data'])
                        ->where('db_id', '<>', 0)
                        ->orderByDesc('num');
                },
            ])
            ->orderBy('date')
            ->paginate(15);
    }


    private function getMatch(int $id, bool $withTournament = false): ?object
    {
        return DB::table('gt_match')
            ->select(['info', 'gt_match_list.game_id', 'gt_match_list.date', 'gt_match_list.title', 't1', 't2', 'bo', 't1s', 't2s'])
            ->join('gt_match_list', 'gt_match.id', '=', 'gt_match_list.id')
            ->when($withTournament, function (Builder $query) {
                return $query->addSelect([
                    'gt_tournaments.id as tournament_id',
                    'gt_tournaments.eng as tournament_eng',
                    'gt_tournaments.title as tournament_title',
                    'gt_tournaments.icon as tournament_icon',
                    'gt_tournaments.prize as tournament_prize',
                ])->join('gt_tournaments', function (JoinClause $query) {
                    return $query->on('gt_tournaments.id', '=', 'gt_match_list.tid');
                });
            })
            ->where('gt_match.id', $id)
            ->whereIn('gt_match_list.game_id', static::DISCIPLINES)
            ->first();
    }

    private function getPlayedMatchGames(int $matchId): Collection
    {
        return DB::table('gt_match_game')
            ->select(['id', 'num', 'match_data'])
            ->where('db_id', '<>', 0)
            ->where('mid', $matchId)
            ->orderByDesc('num')
            ->get();
    }

    private function getMatchEvents(int $gameId, ?MatchDataDto $matchData = null, ?int $matchGameId = null): array
    {
        if ($gameId == GameEnum::LOL->value) {
            if ($matchData?->events) {
                return $matchData->events;
            }
        } elseif ($gameId == GameEnum::DOTA2->value) {
            if ($matchGameId) {
                return DB::table('gt_match_582_events')
                    ->where('id', $matchGameId)
                    ->get()
                    ->all();
            }
        }

        return [];
    }

    public function preview(int $id): ?MatchDto
    {
        if (($match = $this->getMatch($id)) === null) {
            throw new NotFoundHttpException();
        }

        /** @var MatchDataDto $matchData */
        $game = $this->getPlayedMatchGames($id)->first();
        $dto = $this->buildMatchDto($match, $game, $matchData);
        $events = $this->getMatchEvents($match->game_id, $matchData, $game?->id);

        $dto->setAggregatedEvents(
            EventService::discipline($match->game_id)->aggregateEvents($events)
        );

        return $dto;
    }

    public function show(int $id, ?int $num = null): MatchDto
    {
        if (($match = $this->getMatch($id, true)) === null) {
            throw new NotFoundHttpException();
        }

        /** @var MatchDataDto $matchData */
        $games = $this->getPlayedMatchGames($id);
        $game = $games->first($num ? (fn(object $game) => $game->num == $num) : null);

        $dto = $this->buildMatchDto($match, $game, $matchData);
        $events = $this->getMatchEvents($match->game_id, $matchData, $game?->id);

        $dto->setTournament(new TournamentDto(
            $match->tournament_id,
            $match->tournament_eng,
            $match->tournament_title,
            $match->tournament_icon,
            $match->tournament_prize,
        ));

        $dto->setAggregatedEvents(
            EventService::discipline($match->game_id)->aggregateEvents($events)
        );

        $dto->setEvents(
            EventService::discipline($match->game_id)->handleEvents($events)
        );

        $title = MatchTitleDto::fromJson($match->title);

        $dto->setGameId((int) $match->game_id);
        $dto->setStatus((int) $title->live);
        $dto->setBestOf((int) $match->bo);
        $dto->setLiveNum($games->first()?->num);
        $dto->setMatchStart($match->date);

        return $dto;
    }

    private function buildMatchDto(object $match, ?object $game, &$matchData): ?MatchDto
    {
        // gt_match_game
        $matchData = MatchDataDto::fromJson($game?->match_data, GameEnum::from($match->game_id));

        // gt_match
        $info = MatchInfoDto::fromJson(
            $match->info,
            ($matchData?->team1->id ?? $match->t1),
            ($matchData?->team2->id ?? $match->t2)
        );

        $dto = new MatchDto();

        $dto->setNum($game?->num ?? 1);

        if ($matchData) {
            $dto->setGold($matchData->gold);
            $dto->setDuration($matchData->duration);
            $dto->setHasMatchData(true);

            if ($matchData->team1->winner) {
                $dto->setWinner('t1');
            } elseif ($matchData->team2->winner) {
                $dto->setWinner('t2');
            }

            $team1 = new MatchDetailsTeamDto(
                $matchData->team1->id,
                $matchData->team1->title,
                $matchData->team1->score,
                bans: $matchData->team1->bans,
                picks: $matchData->team1->picks,
                goldAdvantage: $matchData->team1->goldAdvantage,
                expAdvantage: $matchData->getTeam1ExperienceAdvantage()
            );

            $team2 = new MatchDetailsTeamDto(
                $matchData->team2->id,
                $matchData->team2->title,
                $matchData->team2->score,
                bans: $matchData->team2->bans,
                picks: $matchData->team2->picks,
                goldAdvantage: $matchData->team2->goldAdvantage,
                expAdvantage: $matchData->getTeam2ExperienceAdvantage()
            );

            if ($matchData->team1->players) {
                $map = array_column(
                    [
                        ...$info->team1->players,
                        ...$info->team2->players,
                    ],
                    null,
                    'id'
                );

                $callback = fn(MatchGamePlayerDto $player) => new MatchDetailsPlayerDto(
                    $map[$player->id] ?? new PlayerDto(id: $player->id, nick: $player->nick),
                    $player
                );

                $team1->setPlayers(
                    array_map($callback, $matchData->team1->players)
                );

                $team2->setPlayers(
                    array_map($callback, $matchData->team2->players)
                );
            }
        } else {
            $team1 = new MatchDetailsTeamDto($match->t1);
            $team2 = new MatchDetailsTeamDto($match->t2);
        }

        $dto->setTeam1($team1);
        $dto->setTeam2($team2);

        /** @var array<\App\Dto\Match\TeamDto> $infoTeamMap */
        $infoTeamMap = [
            $match->t1 => $info->team1,
            $match->t2 => $info->team2
        ];

        $matchTeamMap = [
            $match->t1 => $match->t1s,
            $match->t2 => $match->t2s
        ];

        $team1->setMatchScore($matchTeamMap[$team1->id]);
        $team2->setMatchScore($matchTeamMap[$team2->id]);

        if (!$team1->hasPlayers()) {
            $callback = fn(PlayerDto $player) => new MatchDetailsPlayerDto(
                $player,
                new MatchGamePlayerDto($player->id, $player->nick)
            );

            $team1->setPlayers(array_map($callback, $infoTeamMap[$team1->id]->players));
            $team2->setPlayers(array_map($callback, $infoTeamMap[$team2->id]->players));
        }

        $team1->setShortTitle($infoTeamMap[$team1->id]->shortName);
        $team1->setHasLogo(!empty($infoTeamMap[$team1->id]->logo));

        $team2->setShortTitle($infoTeamMap[$team2->id]->shortName);
        $team2->setHasLogo(!empty($infoTeamMap[$team2->id]->logo));

        if (!$team1->hasTitle()) {
            $team1->setTitle($infoTeamMap[$team1->id]->name);
            $team2->setTitle($infoTeamMap[$team2->id]->name);
        }

        return $dto;
    }

    public function liveMatchBuilder(GtMatchList $match): void
    {
        $match->current_game = null;

        if ($this->isLive($match)) {
            $match->is_live = true;

            $this->identifyLiveGameDiscipline($match);

            if ($match->current_game) {
                $match->current_game->events = $this->determineEventsAffiliation($match);
            }

            if ($match->matchLolLiveGame) {
                $event = new LolEvents();

                $match->current_game->fb = $event->firstBlood($match->current_game->events);
                $match->current_game->first_ten_kills = $event->firstTenKills($match->current_game->events);
                $match->current_game->destroyed_first_tower = $event->firstDestroyedTower($match->current_game->events);
                $match->current_game->killed_first_elite_creep = $event->firstKilledEliteCreep($match->current_game->events);

                if ($match->current_game->match_data
                    && $match?->current_game?->match_data['teams']['t1']['players']
                    &&  $match?->current_game?->match_data['teams']['t2']['players']) {
                    $match->current_game->advantage_exp = $this->advantageInExperience(
                        $match?->current_game?->match_data['teams']['t1']['players'],
                        $match?->current_game?->match_data['teams']['t2']['players'],
                        $match?->current_game?->match_data['duration']
                    );
                    $match->current_game->biggest_net = $this->biggestNet(
                        $match?->current_game?->match_data['teams']['t1']['players'],
                        $match?->current_game?->match_data['teams']['t2']['players']
                    );
                } else {
                    $match->current_game->advantage_exp = 0;
                    $match->current_game->biggest_net = 0;
                }
            }

            if ($match->matchDotaLiveGame) {
                $event = new DotaEvents();

                $match->current_game->fb = $event->firstBlood($match->current_game->events);
                $match->current_game->first_ten_kills = $event->firstTenKills($match->current_game->events);
                $match->current_game->destroyed_first_tower = $event->firstDestroyedTower($match->current_game->events);
                $match->current_game->killed_first_elite_creep = $event->firstKilledEliteCreep(
                    $match->current_game->events
                );

                if ($match->current_game->match_data
                    && $match?->current_game?->match_data['teams']['t1']['players']
                    &&  $match?->current_game?->match_data['teams']['t2']['players']) {
                    $match->current_game->advantage_exp = $this->advantageInExperience(
                        $match?->current_game?->match_data['teams']['t1']['players'],
                        $match?->current_game?->match_data['teams']['t2']['players'],
                        $match?->current_game?->match_data['duration']
                    );
                    $match->current_game->biggest_net = $this->biggestNet(
                        $match?->current_game?->match_data['teams']['t1']['players'],
                        $match?->current_game?->match_data['teams']['t2']['players']
                    );
                } else {
                    $match->current_game->advantage_exp = 0;
                    $match->current_game->biggest_net = 0;
                }
            }
        } else {
            $match->is_live = false;
        }

        unset($match->matchDotaLiveGame, $match->matchLolLiveGame);
    }

    public function offlineMatchBuilder(GtMatchList $match): void
    {
        foreach ($match->matchGames as $game) {
            if ($match->game_id == GamesType::DOTA2->broadcast()) {
                $game->events = [];

                if ($game->dotaEvents()->exists()) {
                    $events = [];

                    foreach ($game->dotaEvents as $event) {
                        $events[$event->time] = $event->logs;
                    }

                    $game->events = $events;
                }

                unset($game->dotaEvents);

                $event = new DotaEvents();

                $game->fb = $event->firstBlood($game->events);
                $game->first_ten_kills = $event->firstTenKills($game->events);
                $game->destroyed_first_tower = $event->firstDestroyedTower($game->events);
                $game->killed_first_elite_creep = $event->firstKilledEliteCreep($game->events);

                if ($game->match_data
                    && $game->match_data['teams']['t1']['players']
                    &&  $game->match_data['teams']['t2']['players']) {
                    $game->advantage_exp = $this->advantageInExperience(
                        $game->match_data['teams']['t1']['players'],
                        $game->match_data['teams']['t2']['players'],
                        $game->match_data['duration'],
                    );
                    $game->biggest_net = $this->biggestNet(
                        $game->match_data['teams']['t1']['players'],
                        $game->match_data['teams']['t2']['players']
                    );
                } else {
                    $game->advantage_exp = 0;
                    $game->biggest_net = 0;
                }
            }

            if ($match->game_id == GamesType::LOL->broadcast()) {
                if ($game->match_data && count($game->match_data['events']) > 0) {
                    $game->events = $game->match_data['events'];
                } else {
                    $game->events = [];
                }

                $event = new LolEvents();

                $game->fb = $event->firstBlood($game->events);
                $game->first_ten_kills = $event->firstTenKills($game->events);
                $game->destroyed_first_tower = $event->firstDestroyedTower($game->events);
                $game->killed_first_elite_creep = $event->firstKilledEliteCreep($game->events);

                if ($game->match_data
                    && $game->match_data['teams']['t1']['players']
                    && $game->match_data['teams']['t2']['players']) {
                    $game->advantage_exp = $this->advantageInExperience(
                        $game->match_data['teams']['t1']['players'],
                        $game->match_data['teams']['t2']['players'],
                        $game->match_data['duration']
                    );
                    $game->biggest_net = $this->biggestNet(
                        $game->match_data['teams']['t1']['players'],
                        $game->match_data['teams']['t2']['players']
                    );
                } else {
                    $game->advantage_exp = 0;
                    $game->biggest_net = 0;
                }
            }
        }
    }

    public function buildGameLogs(GtMatchList $match, int $num): array
    {
        if ($match->game_id == GamesType::DOTA2->broadcast()) {
            $logs = new DotaLogs();
            return $logs->getLogs($match, $num);
        }

        if ($match->game_id == GamesType::LOL->broadcast()) {
            $logs = new LolLogs();
            return $logs->getLogs($match, $num);
        }

        return [];
    }

    public function determineEventsAffiliation(GtMatchList $match): array
    {
        if ($match->matchDotaLiveGame) {
            $events = [];

            if ($match->matchDotaLiveGame->dotaEvents()->exists()) {
                foreach ($match->matchDotaLiveGame->dotaEvents as $event) {
                    $events[$event->time] = $event->logs;
                }
            }

            unset($match->matchDotaLiveGame->dotaEvents);

            return $events;
        }

        if ($match->matchLolLiveGame
            && $match?->current_game->match_data
            && count($match->current_game->match_data['events']) > 0) {
            return $match->current_game->match_data['events'];
        }

        return [];
    }


    private function identifyLiveGameDiscipline(GtMatchList $match): void
    {
        if ($match->matchDotaLiveGame) {
            $match->current_game = $match->matchDotaLiveGame;
        }

        if ($match->matchLolLiveGame) {
            $match->current_game = $match->matchLolLiveGame;
        }
    }

    private function isLive(GtMatchList $match): bool
    {
        $title = explode('/', $match->title);

        return $title[2] === '1';
    }

    private function advantageInExperience(array $team1Players, array $team2Players, int $duration): int
    {
        $expTeam1 = 0;
        $expTeam2 = 0;


        foreach ($team1Players as $player) {
            if (array_key_exists('xpm', $player)) {
                $expTeam1 += $player['xpm'] * floor($duration / 60);
            }
        }

        foreach ($team2Players as $player) {
            if (array_key_exists('xpm', $player)) {
                $expTeam2 += $player['xpm'] * floor($duration / 60);
            }
        }

        return $expTeam1 - $expTeam2;
    }

    private function biggestNet(array $team1Players, array $team2Players): int
    {
        $team1 = max(array_column($team1Players, 'n'));
        $team2 = max(array_column($team2Players, 'n'));

        if (!$team1 || !$team2) {
            return 0;
        }

        return max($team1, $team2);
    }

    public function biggestNetMatch(array $team1Players, array $team2Players): int
    {
        $team1 = max(array_map(function ($player) {
            return $player->matchGamePlayer->netWorth;
        }, $team1Players));

        $team2 = max(array_map(function ($player) {
            return $player->matchGamePlayer->netWorth;
        }, $team2Players));

        if (!$team1 || !$team2) {
            return 0;
        }

        return max($team1, $team2);
    }

    public function sortPlayersDeskByNetWorth($players) {
         usort($players, function ($a, $b) {
            return $b->matchGamePlayer->netWorth - $a->matchGamePlayer->netWorth;
         });

         return $players;
    }

    public function getTournaments($request) {
        $query = $request->get('query');
        $tournaments = DB::table('gt_tournaments')
            ->when($request->has('query'), function ($q) use ($query) {
                $searchService = new SearchService();
                $search = $searchService->query('event', 3, $query, 0, [], 100);
                $q->whereIn('gt_tournaments.id', $search['ids'] ?? []);
            })
            ->where('gt_tournaments.is_current', '=', '1')
            ->whereIn('gt_tournaments.game_id', [GamesType::DOTA2->broadcast(), GamesType::LOL->broadcast()])
            ->when(!$request->has('query'), function ($q) {
                $q->join('esn_top_list', 'esn_top_list.id', 'gt_tournaments.id')
                    ->where('esn_top_list.rid', '=', 'event')
                    ->orderBy('esn_top_list.kol', 'desc');
            })
            ->limit(5)
            ->get([
                'gt_tournaments.id',
                'gt_tournaments.eng',
                'gt_tournaments.title',
                'gt_tournaments.logo'

            ]);
        return $tournaments;
    }

    public function getTeams($request) {
        $query = $request->get('query');

        $teams = DB::table('gt_teams_list')
            ->when($request->has('query'), function ($q) use ($query) {
                $searchService = new SearchService();
                $search = $searchService->query('team', 1, $query, 0, [], 100);
                $q->whereIn('gt_tournaments.id', $search['ids'] ?? []);
            })
            ->where('gt_teams_list.is_act', '=', '1')
            ->whereIn('gt_teams_list.game_id', [GamesType::DOTA2->broadcast(), GamesType::LOL->broadcast()])
            ->limit(8)
            ->when(!$request->has('query'), function ($q) {
                $q->join('esn_top_list', 'esn_top_list.id', 'gt_teams_list.id')
                    ->where('esn_top_list.rid', '=', 'team')
                    ->orderBy('esn_top_list.kol', 'desc');
            })
            ->get([
                'gt_teams_list.id',
                'gt_teams_list.eng',
                'gt_teams_list.title',
                'gt_teams_list.logo'
            ]);

        return $teams;
    }
}
