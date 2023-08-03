<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\History\HistoryDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin HistoryDto
 */
class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            't1' => [
                'id' => $this->team1Id,
                'short_title' => $this->matchTitle->team1->shortTitle,
                'has_icon' => $this->matchTitle->team1->hasLogo(),
                'matches' => HistoryBlockResource::collection($this->team1Block)
            ],
            't2' => [
                'id' => $this->team2Id,
                'short_title' => $this->matchTitle->team2->shortTitle,
                'has_icon' => $this->matchTitle->team2->hasLogo(),
                'matches' => HistoryBlockResource::collection($this->team2Block)
            ],
            'common' => [
                'matches' => HistoryBlockResource::collection($this->commonBlock)
            ],
        ];
    }
}
