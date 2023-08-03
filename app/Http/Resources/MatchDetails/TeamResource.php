<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\TeamDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin TeamDto
 */
class TeamResource extends JsonResource
{
    public function __construct($resource, private readonly bool $fullPlayer = false)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTitle(),
            'short_title' => $this->getShortTitle(),
            'has_icon' => $this->isHasLogo(),
            'players' => $this->when(
                $this->fullPlayer,
                FullPlayerResource::collection($this->getPlayers()),
                PlayerResource::collection($this->getPlayers())
            ),
            $this->mergeWhen($this->fullPlayer, fn() => [
                'picks' => $this->getPicks(),
                'bans' => $this->getBans(),
                'match_score' => $this->getMatchScore(),
                'map_score' => $this->getScore()
            ]),
            'gold_adv' => $this->getGoldAdvantage(),
            'exp_adv' => $this->getExpAdvantage(),
        ];
    }
}
