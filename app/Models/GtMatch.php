<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\GtMatchList;

class GtMatch extends Model
{
    use HasFactory;

    protected $table = 'gt_match';
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'info' => 'array'
    ];

    public function matchList(): HasOne
    {
        return $this->hasOne(GtMatchList::class);
    }
}
