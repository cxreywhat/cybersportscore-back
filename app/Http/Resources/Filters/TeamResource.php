<?php

namespace App\Http\Resources\Filters;

use App\Enums\GameEnum;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $eng
 * @property int $game_id
 * @property string $logo
 */
class TeamResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'eng' => $this->eng,
            'game_id' => $this->game_id,
            'game_eng' => GameEnum::from($this->game_id)->eng(),
            'has_icon' => !empty($this->logo),
        ];
    }
}
