<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtCountry extends Model
{
    protected $table = 'gt_country';

    public function trafficRules()
    {
        return $this->hasMany(EsnTrafficRule::class, 'cid');
    }
}
