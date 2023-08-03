<?php

namespace App\Models;

use App\Dto\MatchGame\MatchDataDto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $mid
 * @property int $db_id
 * @property int $num
 * @property int $duration
 * @property array $match_data
 *
 * @property ?MatchDataDto $matchDataObject
 */
class GtMatchGame extends Model
{
    use HasFactory;

    protected $table = 'gt_match_game';
    public $timestamps = false;
    protected $guarded = [];

    protected ?MatchDataDto $matchDataDto = null;

    protected $casts = [
        'match_data' => 'array',
        'match_data_result' => 'array',
    ];

    protected function matchDataObject(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => MatchDataDto::fromArray($this->match_data),
        );
    }

    public function dotaEvents(): HasMany
    {
        return $this->hasMany(GtMatch582Event::class, 'id', 'id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(GtMatchTeam::class, 'mid', 'id');
    }

    public function matchList(): BelongsTo
    {
        return $this->belongsTo(GtMatchList::class, 'mid', 'id');
    }
}
