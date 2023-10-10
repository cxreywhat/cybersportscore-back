<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsItemResource;
use App\Http\Resources\NewsListResource;
use App\Services\NewsService;
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

        return view($request->ajax() ? 'ajax.newsList' : 'newsList', [
            'data' => $data,
        ]);
    }

    public function show(Request $request, string $id, NewsService $service)
    {
        $data = new NewsItemResource(
            $service->getNewsItem($id, (bool) $request->get('preview'))
        );
        $news = NewsListResource::collection(
            $service->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $request->get('lang'),
                'per_page' => $request->get('perPage'),
            ])
        );

        $blocks = json_decode($data->blocks);
        $timestamp = $data->data + 3 * 3600;
        $months = array( 1 => 'янв.', 2 => 'фев.', 3 => 'мар.', 4 => 'апр.', 5 => 'мая', 6 => 'июн.', 7 => 'июл.', 8 => 'авг.', 9 => 'сен.', 10 => 'окт.', 11 => 'ноя.', 12 => 'дек.');
        $formattedDate = date('j ', $timestamp) . $months[date('n', $timestamp)] . date(', Y H:i', $timestamp);

        return view($request->ajax() ? 'ajax.newsArticle' : 'newsArticle', [
                'count' => 10,
                'data' => $data,
                'news' => $news,
                'blocks' => $blocks,
                'timestamp' => $timestamp,
                'formattedDate' => $formattedDate
            ]
        );
    }
}
