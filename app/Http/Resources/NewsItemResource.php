<?php

namespace App\Http\Resources;

use App\Models\EsnNews;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin EsnNews
 */
class NewsItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'blocks' => $this->blocks,
            'info' => $this->info,
            'pic' => $this->pic,
            'pic_in' => $this->pic_in,
            'lang' => $this->lang,
            'published_at' => $this->data
        ];
    }
}
