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
        $data = MatchListResource::collection(
            $this->matchService->getList($matchRequest->validated())->items()
        );
        $pages = $this->matchService->getList($matchRequest->validated());

        $tournaments = $this->matchService->getTournaments($request);
        $teams = $this->matchService->getTeams($request);

        return view($request->ajax() ? 'ajax.home' : 'home', [
            'teams' => $teams,
            'tournaments' => $tournaments,
            'items' => $data,
            'pages' => $pages
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
        $pages = $this->matchService->getList($matchRequest->validated());

        $tournaments = $this->matchService->getTournaments($request);
        $teams = $this->matchService->getTeams($request);

        event(new HomeUpdate([
            'teams' => $teams,
            'tournaments' => $tournaments,
            'matches' => $data,
            'pages' => $pages
        ]));
    }
}
