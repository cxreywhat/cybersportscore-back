<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsItemResource;
use App\Http\Resources\NewsListResource;
use App\Services\NewsService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, NewsService $service)
    {
        $data = NewsListResource::collection(
            $service->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $request->get('lang'),
                'per_page' => $request->get('perPage'),
            ])
        );

        return view('newsList', [
            'data' => $data
        ]);
    }

    public function show(Request $request, string $block, NewsService $service)
    {
        $id = preg_replace('/^(\d+)-.*$/', '$1', $block);
        $data = new NewsItemResource(
            $service->getNewsItem($id, (bool) $request->get('preview'))
        );

        return view('newsArticle', [
            'data' => $data]
        );
    }
}
