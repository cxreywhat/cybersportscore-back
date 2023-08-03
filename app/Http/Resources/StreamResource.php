<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $game_id
 * @property int $viewers
 * @property int $online
 * @property string $pic
 * @property string $title
 * @property string $lang
 * @property string $status
 * @property string $logo_url
 * @property string $site
 * @property string $eng
 * @property string $sub
 */
class StreamResource extends JsonResource
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
            'picture_url' => $this->pic,
            'title' => $this->title,
            'game_id' => $this->game_id,
            'lang' => $this->lang,
            'status' => $this->status,
            'logo_url' => $this->logo_url,
            'site' => $this->site,
            'viewers' => $this->viewers,
            'online' => (bool) $this->online,
            'eng' => $this->eng,
            'sub' => $this->sub,
        ];
    }
}
