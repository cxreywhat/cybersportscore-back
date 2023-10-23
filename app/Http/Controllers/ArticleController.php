<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsItemResource;
use App\Http\Resources\NewsListResource;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function Termwind\render;

class ArticleController extends Controller
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService) {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $lang = $request->language;

        $data = NewsListResource::collection(
            $this->newsService->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $lang,
                'per_page' => $request->get('perPage'),
            ])
        );

        return view($request->ajax() ? 'ajax.newsList' : 'newsList', [
            'news' => $data,
            'isNewsPage' => true,
            'lang' => $lang
        ]);
    }

    public function show(Request $request)
    {
        $id = intval($request->id);
        $lang = $request->language;

        $data = new NewsItemResource(
            $this->newsService->getNewsItem($id, (bool) $request->get('preview'))
        );

        Carbon::setLocale($lang);

        $timestamp = $data->data + 3 * 3600;
        $monthNum = date('n', $timestamp);

        $months = Carbon::create()->month($monthNum)->monthName;
        $blocks = json_decode($data->blocks);

        $formattedDate = date('j ', $timestamp) . $months . date(', Y H:i', $timestamp);

        $news = NewsListResource::collection(
            $this->newsService->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $lang,
                'per_page' => 10,
            ])
        );

        return view($request->ajax() ? 'ajax.newsArticle' : 'newsArticle', [
                'data' => $data,
                'blocks' => $blocks,
                'timestamp' => $timestamp,
                'formattedDate' => $formattedDate,
                'news' => $news,
                'isNewsPage' => false,
                'lang' => $lang
            ]
        );
    }

    public function articlesBlock(Request $request)
    {

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
