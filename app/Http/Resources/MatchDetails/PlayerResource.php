<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\PlayerDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PlayerDto
 */
class PlayerResource extends JsonResource
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
            'id' => $this->matchGamePlayer->id,
            'hero_id' => $this->matchGamePlayer->heroId,
            'level' => $this->matchGamePlayer->level,
            'net_worth' => $this->matchGamePlayer->netWorth,
            'side' => $this->matchGamePlayer->side,
            'nick' => $this->matchGamePlayer->nick,
            'hero_title' => $this->matchGamePlayer->heroTitle,
            'role' => $this->matchPlayer->role,
            'country_id' => $this->matchPlayer->countryId,
        ];
    }
}
