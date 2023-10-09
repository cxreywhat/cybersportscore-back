<?php

namespace App\Http\Controllers;

use App\Enums\GamesType;
use App\Http\Requests\MatchesRequest;
use App\Http\Resources\MatchDetails\HistoryBlockResource;
use App\Http\Resources\MatchDetails\HistoryResource;
use App\Http\Resources\MatchDetails\MatchResource;
use App\Http\Resources\MatchDetails\PreviewResource;
use App\Http\Resources\MatchList\MatchListResource;
use App\Models\GtMatchList;
use App\Services\MatchService;
use Carbon\Carbon;
use Dmp\Services\SearchServices\SearchService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JsonException;

class MatchController extends Controller
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index(MatchesRequest $request): Responsable
    {
        return MatchListResource::collection(
            $this->matchService->getList($request->validated())
        );
    }

    public function showPreview(Request $request, int $id): Responsable
    {
        return new PreviewResource(
            $this->matchService->preview($id)
        );
    }

    public function show(Request $request, int $id): Responsable
    {
        $data = new MatchResource(
            $this->matchService->show($id, $request->get('num'))
        );

        return $data;
    }

    public function showHistory(Request $request, int $id, ?string $side = null): Responsable
    {
        $history = $this->matchService->getHistory($id, $side);

        if ($side) {
            return HistoryBlockResource::collection($history);
        }

        return new HistoryResource($history);
    }

    /**
     * @throws JsonException
     */
    public function matchesBeta(Request $request)
    {
        $tournament = [];
        $team = [];

        if ($request->has('tournament')) {
            $tournament = DB::table('gt_tournaments')
                ->where('id', '=', $request->get('tournament'))
                ->first(['id']);
        }

        if ($request->has('team')) {
            $team = DB::table('gt_teams_list')
                ->where('id', '=', $request->get('team'))
                ->first(['id']);
        }

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(3);

        $matches = GtMatchList::query()
            ->with([
                'match',
                'matchDotaLiveGame' => function ($q) {
                    $q
                        ->with('dotaEvents')
                        ->whereHas('matchList', function ($q) {
                            $q->where('gt_match_list.game_id', GamesType::DOTA2->broadcast());
                        });
                },
                'matchLolLiveGame' => function ($q) {
                    $q
                        ->whereHas('matchList', function ($q) {
                            $q->where('gt_match_list.game_id', GamesType::LOL->broadcast());
                        });
                }
            ])
            ->when($request->has('game_id'), function ($query) use ($request) {
                $query->where('gt_match_list.game_id', '=', $request->get('game_id'));
            })
            ->when($request->has('tournament'), function ($query) use ($tournament) {
                $query->where('gt_match_list.tid', '=', $tournament?->id);
            })
            ->when($request->has('team'), function ($query) use ($team) {
                $query->whereRelation('team', 'tid', '=', $team?->id);
            })
            ->when(
                $request->has('game_id')
                && $request->get('game_id') === GamesType::DOTA2->broadcast(),
                function ($query) {
                    $query->with('dotaEvents');
                }
            )
            ->where('gt_match_list.is_current', '=', '1')
            ->whereIn('game_id', [GamesType::DOTA2->broadcast(), GamesType::LOL->broadcast()])
            ->whereBetween('gt_match_list.date', [$startDate, $endDate])
            ->orderBy('gt_match_list.date')
            ->paginate();

        foreach ($matches as $match) {
            $this->matchService->liveMatchBuilder($match);
        }

        return response()->json($matches);
    }

    public function matchBeta(int $id): JsonResponse
    {
        $match = GtMatchList::query()
            ->with([
                'match',
                'matchGames',
                'matchDotaLiveGame' => function ($q) {
                    $q
                        ->with('dotaEvents')
                        ->whereHas('matchList', function ($q) {
                            $q->where('gt_match_list.game_id', GamesType::DOTA2->broadcast());
                        });
                },
                'matchLolLiveGame' => function ($q) {
                    $q
                        ->whereHas('matchList', function ($q) {
                            $q->where('gt_match_list.game_id', GamesType::LOL->broadcast());
                        });
                }
            ])
            ->find($id);

        if ($match) {
            $this->matchService->liveMatchBuilder($match);
            $this->matchService->offlineMatchBuilder($match);
        }

        return response()->json($match);
    }

    public function getGameLogs(int $id, int $num): JsonResponse
    {
        $match = GtMatchList::query()
            ->with([
                'match',
                'matchGames'
            ])
            ->find($id);

        if ($match) {
            return response()->json($this->matchService->buildGameLogs($match, $num));
        }

        return response()->json();
    }

    public function matchesByTeam(Request $request): JsonResponse
    {
        $tournament = [];
        $team = [];

        if ($request->has('tournament')) {
            $tournament = DB::table('gt_tournaments')
                ->where('id', '=', $request->get('tournament'))
                ->first(['id']);
        }

        if ($request->has('team')) {
            $team = DB::table('gt_teams_list')
                ->where('id', '=', $request->get('team'))
                ->first(['id']);
        }

        $matches = GtMatchList::query()
            ->with('match')
            ->when($request->has('game_id'), function ($query) use ($request) {
                $query->where('gt_match_list.game_id', '=', $request->get('game_id'));
            })
            ->when($request->has('tournament'), function ($query) use ($tournament) {
                $query->where('gt_match_list.tid', '=', $tournament?->id);
            })
            ->when($request->has('team'), function ($query) use ($team) {
                $query->whereRelation('team', 'tid', '=', $team?->id);
            })
            ->where('gt_match_list.is_current', '=', '2')
            ->whereIn('game_id', [GamesType::DOTA2->broadcast(), GamesType::LOL->broadcast()])
            ->where('gt_match_list.t1', $request->get('team_id'))
            ->orderBy('gt_match_list.date')
            ->limit(6)
            ->get();

        return response()->json($matches);
    }

    public function tournaments(Request $request): JsonResponse
    {

        $query = $request->get('query');

        $tournaments = DB::table('gt_tournaments')
            ->when($request->has('query'), function ($q) use ($query) {
                $searchService = new SearchService();
                $search = $searchService->query('event', 5, $query, [], 0, 100);
                $q->whereIn('gt_tournaments.id', $search['ids'] ?? []);
            })
            ->where('gt_tournaments.is_current', '=', '1')
            ->whereIn('gt_tournaments.game_id', [GamesType::DOTA2->broadcast(), GamesType::LOL->broadcast()])
            ->when(!$request->has('query'), function ($q) {
                $q->join('esn_top_list', 'esn_top_list.id', 'gt_tournaments.id')
                    ->where('esn_top_list.rid', '=', 'event')
                    ->orderBy('esn_top_list.kol', 'desc');
            })
            ->limit(8)
            ->get([
                'gt_tournaments.id',
                'gt_tournaments.eng',
                'gt_tournaments.title',
                'gt_tournaments.logo'

            ]);

        return response()->json($tournaments);
    }

    public function teams(Request $request): JsonResponse
    {
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

        return response()->json($teams);
    }
}
