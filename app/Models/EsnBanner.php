<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsnBanner extends Model
{
    protected $table = 'esn_banners';

    public function position()
    {
        return $this->belongsTo(EsnBannerPosition::class, 'position_id');
    }

    public function traffic()
    {
        return $this->belongsTo(EsnTraffic::class, 'traffic_rule');
    }

}
