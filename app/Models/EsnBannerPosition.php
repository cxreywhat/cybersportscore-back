<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsnBannerPosition extends Model
{
    protected $table = 'esn_banner_positions';

    public function banners()
    {
        return $this->hasMany(EsnBanner::class, 'position_id');
    }
}
