<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsItemResource;
use App\Http\Resources\NewsListResource;
use App\Services\NewsService;
use Illuminate\Http\Request;

class WebsocketController extends Controller
{
    public function getEchoConfig(Request $request)
    {
        if (request()->ajax()) {

            $config = [
                'broadcaster' => config('broadcasting.default'),
                'key' => config('broadcasting.connections.pusher.key'),
                'wsHost' => config('broadcasting.connections.pusher.options.host'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'wsPort' => config('broadcasting.connections.pusher.options.port'),
                'wssPort' => config('broadcasting.connections.pusher.options.port'),
                'forceTLS' => false,
                'encrypted' => true,
                'disableStats' => true,
                'enabledTransports' => ['ws', 'wss'],
                'activityTimeout' => 50000000,
            ];

            return response()->json($config);
        }

        return response('Access Denied', 403);
    }
}
