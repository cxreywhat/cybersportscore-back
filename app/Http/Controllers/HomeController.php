<?php

namespace App\Http\Controllers;

use App\Enums\GamesType;
use App\Events\HomeDetailsUpdate;
use App\Events\HomeUpdate;
use App\Http\Requests\MatchesRequest;
use App\Http\Resources\MatchDetails\MatchResource;
use App\Http\Resources\MatchDetails\PreviewResource;
use App\Http\Resources\MatchList\MatchListResource;
use App\Http\Resources\NewsListResource;
use App\Models\GtMatchList;
use App\Services\MatchService;
use App\Services\NewsService;
use Illuminate\Http\Request;
use function Termwind\render;

class HomeController extends Controller
{
    private MatchService $matchService;
    private NewsService $newsService;

    public function __construct(MatchService $matchService, NewsService $newsService)
    {
        $this->matchService = $matchService;
        $this->newsService = $newsService;
    }

    public function index(Request $request, MatchesRequest $matchRequest)
    {
        $filters = $matchRequest->validated();
        $gameId = $request->game === 'dota-2' ? 582 : ($request->game ? 313 : null);
        $filters['game_id'] = $gameId;
        $lang = $request->language;
<<<<<<< HEAD
        $data = $this->matchService->getList($filters);

=======
        $data = MatchListResource::collection(
            $this->matchService->getList($filters)->items()
        );
>>>>>>> 06f32db (upd back logic)
        $news = NewsListResource::collection(
            $this->newsService->getNewsList([
                'game_id' => $request->get('game_id'),
                'lang' => $lang,
                'per_page' => 5,
            ])
        );

        $tournaments = $this->matchService->getTournaments($request);
        $teams = $this->matchService->getTeams($request);

        $jsonDataBuildings = file_get_contents("json/dota-2-maps.json");
        $buildings = json_decode($jsonDataBuildings);

        return view($request->ajax() ? 'ajax.home' : 'home', [
            'buildings' => $buildings,
            'teams' => $teams,
            'tournaments' => $tournaments,
            'items' => MatchListResource::collection($data),
            'pages' => $data,
            'news' => $news,
            'isNewsPage' => false,
            'game' => $request->game,
            'gameId' => $gameId,
            'lang' => $lang
        ]);
    }

    public function loader()
    {
        return view('components.common.loader');
    }

    public function details(Request $request) {
        $id = intval($request->get('id'));
        $numMap = intval($request->get('num'));

        $match = new MatchResource(
            $this->matchService->show($id, $numMap)
        );
        $isLive = $match->getStatus() == 1;
        $biggestNet = $this->matchService->biggestNetMatch($match->getTeam1()->getPlayers(), $match->getTeam2()->getPlayers());

        $match->getTeam1()->setPlayers($this->matchService->sortPlayersDeskByNetWorth($match->getTeam1()->getPlayers()));
        $match->getTeam2()->setPlayers($this->matchService->sortPlayersDeskByNetWorth($match->getTeam2()->getPlayers()));

        return view('components.matchesIndex.matchHomeDetails', [
            'match' => $match,
            'biggestNet' => $biggestNet,
            'isLive' => $isLive
        ]);
    }

    public function sendDataDetailsMatch(Request $request) {
        $id = intval($request->get('id'));
        $numMap = intval($request->get('num'));

        $match = new MatchResource(
            $this->matchService->show($id, $numMap)
        );
        $isLive = $match->getStatus() == 1;
        $biggestNet = $this->matchService->biggestNetMatch($match->getTeam1()->getPlayers(), $match->getTeam2()->getPlayers());

        $match->getTeam1()->setPlayers($this->matchService->sortPlayersDeskByNetWorth($match->getTeam1()->getPlayers()));
        $match->getTeam2()->setPlayers($this->matchService->sortPlayersDeskByNetWorth($match->getTeam2()->getPlayers()));

        event(new HomeDetailsUpdate([
            'match' => $match,
            'biggestNet' => $biggestNet,
            'isLive' => $isLive
        ]));
    }

    public function sendData(Request $request, MatchesRequest $matchRequest)
    {
        $data = MatchListResource::collection(
            $this->matchService->getList($matchRequest->validated())->items()
        );

        event(new HomeUpdate([
            'teams' => $this->matchService->getTeams($request),
            'tournaments' => $this->matchService->getTournaments($request),
            'matches' => $data,
            'pages' => $this->matchService->getList($matchRequest->validated())
        ]));
    }
}
