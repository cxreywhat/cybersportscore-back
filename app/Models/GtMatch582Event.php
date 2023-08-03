<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtMatch582Event extends Model
{
    use HasFactory;

    protected $table = 'gt_match_582_events';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'logs' => 'array'
    ];
    public function game()
    {
        return $this->hasOne(GtMatchGame::class, 'id', 'id');
    }
}
