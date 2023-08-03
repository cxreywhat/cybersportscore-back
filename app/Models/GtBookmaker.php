<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtBookmaker extends Model
{
    use HasFactory;

    protected $table = 'gt_bookmaker';
    protected $casts = ['id' => 'string'];
    public $timestamps = false;
    protected $guarded = [];
}
