<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\MatchDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MatchDto
 */
class PreviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'num' => $this->getNum(),
            'duration' => $this->getDuration(),
            'teams' => [
                new TeamResource($this->getTeam1()),
                new TeamResource($this->getTeam2()),
            ],
            'gold' => $this->getGold(),
            'aggregated_events' => $this->getAggregatedEvents()
        ];
    }
}
