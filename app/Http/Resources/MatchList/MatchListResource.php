<?php

namespace App\Http\Resources\MatchList;

use App\Dto\Match\MatchInfoDto;
use App\Enums\GameEnum;
use App\Models\GtMatchGame;
use App\Models\GtMatchList;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin GtMatchList
 *
 * @property string $game_eng
 * @property string $info
 * @property int $tournament_id
 * @property int $bo
 * @property int $t1
 * @property int $t2
 * @property int t1s
 * @property int t2s
 * @property string $tournament_eng
 * @property string $tournament_title
 * @property string $tournament_icon
 */
class MatchListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var GtMatchGame $lastGame */
        if (($lastGame = $this->matchGames->first()) && $lastGame->matchDataObject) {
            if ($lastGame->matchDataObject->team1->winner) {
                $winner = 't1';
            } elseif ($lastGame->matchDataObject->team2->winner) {
                $winner = 't2';
            }

            $hasPicks = $lastGame->matchDataObject->team1->isHasPicks()
                && $lastGame->matchDataObject->team2->isHasPicks();

            $hasBans = $lastGame->matchDataObject->team1->isHasBans()
                && $lastGame->matchDataObject->team2->isHasBans();
        }

        $teams = $this->getOrderedTeams($lastGame);

        return [
            'id' => $this->id,
            'is_live' => $this->matchTitleObject->live,
            'winner' => $winner ?? null,
            'has_match_data' => !empty($lastGame->match_data),
            'has_picks' => $hasPicks ?? false,
            'has_bans' => $hasBans ?? false,
            'game_id' => $this->game_id,
            'game_eng' => GameEnum::from($this->game_id)->eng(),
            'bo' => $this->bo,
            'datetime' => strtotime($this->date),
            'teams' => $teams,
            'event' => [
                'id' => $this->tournament_id,
                'eng' => $this->tournament_eng,
                'title' => $this->tournament_title,
                'has_icon' => !empty($this->tournament_icon)
            ],
            'num' => $lastGame?->num,
            'duration' => $lastGame?->matchDataObject?->duration,
            'odds' => MatchInfoDto::fromJson(
                $this->info,
                $teams[0]['id'],
                $teams[1]['id'],
                $this->id
            )->bets,
        ];
    }

    private function getOrderedTeams(GtMatchGame $lastGame = null): array
    {
        if ($lastGame?->matchDataObject) {
            $teamMap = [
                // gt_match_list
                $this->t1 => [
                    'short_title' => $this->matchTitleObject->team1->shortTitle,
                    'match_score' => $this->t1s, // gt1_match
                    'has_icon' => $this->matchTitleObject->team1->hasLogo()
                ],
                $this->t2 => [
                    'short_title' => $this->matchTitleObject->team2->shortTitle,
                    'match_score' => $this->t2s,
                    'has_icon' => $this->matchTitleObject->team2->hasLogo()
                ],
            ];

            return [
                [
                    'id' => $lastGame->matchDataObject->team1->id,
                    'short_title' => $teamMap[$lastGame->matchDataObject->team1->id]['short_title'],
                    'title' =>  $lastGame->matchDataObject->team1->title,
                    'match_score' => $teamMap[$lastGame->matchDataObject->team1->id]['match_score'],
                    'map_score' => $lastGame->matchDataObject->team1->score,
                    'has_icon' => $teamMap[$lastGame->matchDataObject->team1->id]['has_icon'],
                    'gold_adv' => $lastGame->matchDataObject->team1->goldAdvantage,
                    'exp_adv' => $lastGame->matchDataObject->getTeam1ExperienceAdvantage(),
                ],
                [
                    'id' => $lastGame->matchDataObject->team2->id,
                    'short_title' => $teamMap[$lastGame->matchDataObject->team2->id]['short_title'],
                    'title' => $lastGame->matchDataObject->team2->title,
                    'match_score' => $teamMap[$lastGame->matchDataObject->team2->id]['match_score'],
                    'map_score' => $lastGame->matchDataObject->team2->score,
                    'has_icon' => $teamMap[$lastGame->matchDataObject->team2->id]['has_icon'],
                    'gold_adv' => $lastGame->matchDataObject->team2->goldAdvantage,
                    'exp_adv' => $lastGame->matchDataObject->getTeam2ExperienceAdvantage()
                ]
            ];
        }

        return [
            [
                'id' => $this->t1,
                'short_title' => $this->matchTitleObject->team1->shortTitle,
                'title' => $this->matchTitleObject->team1->shortTitle,
                'match_score' => $this->t1s,
                'map_score' => 0,
                'has_icon' => $this->matchTitleObject->team1->hasLogo(),
                'gold_adv' => 0,
                'exp_adv' => 0
            ],
            [
                'id' => $this->t2,
                'short_title' => $this->matchTitleObject->team2->shortTitle,
                'title' => $this->matchTitleObject->team2->shortTitle,
                'match_score' => $this->t2s,
                'map_score' => 0,
                'has_icon' => $this->matchTitleObject->team2->hasLogo(),
                'gold_adv' => 0,
                'exp_adv' => 0
            ]
        ];
    }
}
