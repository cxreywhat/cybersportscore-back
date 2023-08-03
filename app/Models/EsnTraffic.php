<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsnTraffic extends Model
{
    protected $table = 'esn_traffic';

    public function banners()
    {
        return $this->hasMany(EsnBanner::class, 'traffic_rule');
    }

    public function trafficRule()
    {
        return $this->hasOne(EsnTrafficRule::class, 'rule_id');
    }
}
