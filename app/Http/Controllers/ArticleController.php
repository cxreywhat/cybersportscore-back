<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsItemResource;
use App\Http\Resources\NewsListResource;
use App\Services\NewsService;
use Illuminate\Http\Request;
use function Termwind\render;

class ArticleController extends Controller
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService) {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $data = NewsListResource::collection(
            $this->newsService->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $request->get('lang'),
                'per_page' => $request->get('perPage'),
            ])
        );

        return view($request->ajax() ? 'ajax.newsList' : 'newsList', [
            'data' => $data,
        ]);
    }

    public function show(Request $request, string $id)
    {
        $id = intval($id);
        $data = new NewsItemResource(
            $this->newsService->getNewsItem($id, (bool) $request->get('preview'))
        );

        $blocks = json_decode($data->blocks);
        $timestamp = $data->data + 3 * 3600;
        $months = array( 1 => 'янв.', 2 => 'фев.', 3 => 'мар.', 4 => 'апр.', 5 => 'мая', 6 => 'июн.', 7 => 'июл.', 8 => 'авг.', 9 => 'сен.', 10 => 'окт.', 11 => 'ноя.', 12 => 'дек.');
        $formattedDate = date('j ', $timestamp) . $months[date('n', $timestamp)] . date(', Y H:i', $timestamp);

        return view($request->ajax() ? 'ajax.newsArticle' : 'newsArticle', [
                'data' => $data,
                'blocks' => $blocks,
                'timestamp' => $timestamp,
                'formattedDate' => $formattedDate
            ]
        );
    }

    public function articlesBlock(Request $request) {

        $news = NewsListResource::collection(
            $this->newsService->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $request->get('lang'),
                'per_page' => $request->get('perPage'),
            ])
        );

        $isNewsPage = $request->get('isNewsPage');

        return view('components.matchesIndex.articles', ['news' => $news, 'isNewsPage' => $isNewsPage])->render();
    }
}
