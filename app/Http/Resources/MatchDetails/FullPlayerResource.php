<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\PlayerDto;
use App\Dto\MatchGame\DotaPlayerDto;
use App\Dto\MatchGame\LolPlayerDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PlayerDto
 * @property LolPlayerDto|DotaPlayerDto $matchGamePlayer
 */
class FullPlayerResource extends JsonResource
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
            'id' => $this->matchGamePlayer->id,
            'hero_id' => $this->matchGamePlayer->heroId,
            'level' => $this->matchGamePlayer->level,
            'net_worth' => $this->matchGamePlayer->netWorth,
            'side' => $this->matchGamePlayer->side,
            'nick' => $this->matchGamePlayer->nick,
            'hero_title' => $this->matchGamePlayer->heroTitle,
            'role' => $this->matchPlayer->role,
            'country_id' => $this->matchPlayer->countryId,

            'kills' => $this->matchGamePlayer->getKills(),
            'deaths' => $this->matchGamePlayer->getDeaths(),
            'assists' => $this->matchGamePlayer->getAssists(),
            'last_hits' => $this->matchGamePlayer->getLastHits(),

            $this->mergeWhen($this->matchGamePlayer instanceof LolPlayerDto, fn() => [
                'neutral_last_hits' => $this->matchGamePlayer->getNeutralLastHits(),
                'buildings_damage' => $this->matchGamePlayer->getBuildingsDamage(),
                'wards_placed' => $this->matchGamePlayer->getWardsPlaced(),
                'wards_destroyed' => $this->matchGamePlayer->getWardsDestroyed(),
            ]),

            $this->mergeWhen($this->matchGamePlayer instanceof DotaPlayerDto, fn() => [
                'denies' => $this->matchGamePlayer->getDenies(),
            ]),

            'damage' => $this->matchGamePlayer->getDamage(),
            'damage_taken' => $this->matchGamePlayer->getDamageTaken(),
            'heal' => $this->matchGamePlayer->getHeal(),
            'gpm' => $this->matchGamePlayer->gpm,
            'xpm' => $this->matchGamePlayer->xpm,
            'items' => $this->matchGamePlayer->items,
        ];
    }
}
