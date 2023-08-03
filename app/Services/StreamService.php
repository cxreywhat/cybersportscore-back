<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StreamService
{
    public function getListForMatch(int $matchId): Collection
    {
        return DB::table('gt_stream')
            ->select([
                'id',
                'pic',
                'title',
                'game_id',
                'lang',
                'status',
                'logo_url',
                'site',
                'viewers',
                'online',
                'eng',
                'sub'
            ])
            ->join('gt_match_stream', 'gt_match_stream.sid', 'gt_stream.id')
            ->where('gt_match_stream.mid', $matchId)
            ->where('gt_stream.is_act', '1')
            ->orderByDesc('gt_stream.viewers')
            ->get();
    }
}
