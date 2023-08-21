<?php

namespace App\Http\Controllers;

use App\Enums\GamesType;
use App\Http\Requests\MatchesRequest;
use App\Http\Resources\MatchDetails\PreviewResource;
use App\Http\Resources\MatchList\MatchListResource;
use App\Http\Resources\NewsListResource;
use App\Models\GtMatchList;
use App\Services\MatchService;
use App\Services\NewsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index(Request $request, MatchesRequest $matchRequest, NewsService $newsService)
    {
        $data = MatchListResource::collection(
            $this->matchService->getList($matchRequest->validated())->items()
        );

        $news = NewsListResource::collection(
            $newsService->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $request->get('lang'),
                'per_page' => $request->get('perPage'),
            ])
        );
        $preview = new PreviewResource($this->matchService->preview(522402));


        return view('home', [
            'items' => $data,
            'news' => $news,
            'preview' => $preview
        ]);
    }
}
