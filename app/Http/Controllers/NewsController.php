<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsItemResource;
use App\Http\Resources\NewsListResource;
use App\Services\NewsService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request, NewsService $service): Responsable
    {
        return NewsListResource::collection(
            $service->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $request->get('lang'),
                'per_page' => $request->get('perPage'),
            ])
        );
    }

    public function show(Request $request, int $id, NewsService $service): Responsable
    {
        return new NewsItemResource(
            $service->getNewsItem($id, (bool) $request->get('preview'))
        );
    }
}
