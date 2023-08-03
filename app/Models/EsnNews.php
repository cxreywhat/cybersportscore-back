<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * id
 * @property int $id
 * @property int|string $rid
 * @property int $type
 * @property int $col
 * @property int $ind
 * @property int $block_id
 * @property int|string $is_act
 * @property int|string $rss_ya
 * @property int|string $hide_ind
 * @property int|string $hide_game
 * @property int $game_id
 * @property string $lang
 * @property string $title
 * @property string $eng
 * @property string $descr
 * @property string $blocks
 * @property string $pic
 * @property int|string $pic_in
 * @property int $data
 * @property string $date
 * @property int $ckol
 * @property string $info
 * @property int $user_id
 * @property int|string $is_odds
 * @property int $admin_id
 */
class EsnNews extends Model
{
    use HasFactory;
    public function esnNewsOut(): HasOne
    {
        return $this->hasOne(EsnNewsOut::class);
    }
}
