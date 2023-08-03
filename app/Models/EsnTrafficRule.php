<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsnTrafficRule extends Model
{
    protected $table = 'esn_traffic_rules';

    public function traffic()
    {
        return $this->belongsTo(EsnTraffic::class, 'rule_id');
    }
    public function gtCountry()
    {
        return $this->hasMany(GtCountry::class, 'id', 'cid');
    }
}
