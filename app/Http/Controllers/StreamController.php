<?php

namespace App\Http\Controllers;

use App\Http\Resources\StreamResource;
use App\Services\StreamService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StreamController extends Controller
{
    public function index(Request $request, int $id, StreamService $service): Responsable
    {
        return StreamResource::collection(
            $service->getListForMatch($id)
        );
    }

    public function streams(Request $request): Collection
    {
      return DB::table('gt_stream')
            ->join('gt_match_stream', 'gt_match_stream.sid', 'gt_stream.id')
            ->where('gt_match_stream.mid', $request->get('match_id'))
            ->where('gt_stream.is_act', '=', '1')
            ->orderBy('gt_stream.viewers', 'desc')
            ->get([
                'id',
                'pic',
                'title',
                'game_id',
                'lang',
                'status',
                'logo_url',
                'site',
                'viewers',
                'eng',
                'sub'
            ]);
    }
}
