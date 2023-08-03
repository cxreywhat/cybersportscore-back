<?php

namespace App\Models;

use App\Dto\MatchList\MatchTitleDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $game_id
 * @property string $title
 * @property string $date
 *
 * @property Collection|GtMatchGame[] $matchGames
 * @property Collection|GtMatchTeam[] $team
 *
 * @property bool isLive
 * @property ?MatchTitleDto $matchTitleObject
 */
class GtMatchList extends Model
{
    use HasFactory;

    protected $table = 'gt_match_list';
    public $timestamps = false;
    protected $guarded = [];

    protected ?MatchTitleDto $matchTitleDto = null;

    public function match(): HasOne
    {
        return $this->hasOne(GtMatch::class, 'id', 'id');
    }

    public function team(): HasMany
    {
        return $this->hasMany(GtMatchTeam::class, 'mid', 'id');
    }

    public function matchGames(): HasMany
    {
        return $this->hasMany(GtMatchGame::class, 'mid', 'id');
    }

    public function matchDotaLiveGame(): HasOne
    {
        return $this->hasOne(GtMatchGame::class, 'mid', 'id')
            ->where('match_start', '=', '+')
            ->where('gt_match_game.db_id', '!=', 0)
            ->where('gt_match_game.winner', '=', 0)
            ->where('gt_match_game.match_data', '!=', '')
            ->whereNotNull('gt_match_game.match_data');
    }

    public function matchLolLiveGame(): HasOne
    {
        return $this->hasOne(GtMatchGame::class, 'mid', 'id')
            ->where('gt_match_game.db_id', '!=', 0)
            ->where('gt_match_game.winner', '=', 0)
            ->where('gt_match_game.match_data', '!=', '')
            ->whereNotNull('gt_match_game.match_data');
    }

    public function dotaEvents(): HasManyThrough
    {
        return $this->hasManyThrough(GtMatch582Event::class,GtMatchGame::class,'id', 'id' ,'id', 'mid')
            ->orderBy('time');
    }

    public function getMatchTitleObjectAttribute(): MatchTitleDto
    {
        if (!$this->matchTitleDto) {
            $this->matchTitleDto = MatchTitleDto::fromJson($this->title);
        }

        return $this->matchTitleDto;
    }
}
