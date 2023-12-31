<?php

namespace App\Http\Controllers;

use App\Enums\GamesType;
use App\Events\MatchDataUpdate;
use App\Http\Resources\MatchDetails\HistoryBlockResource;
use App\Http\Resources\MatchDetails\HistoryResource;
use App\Http\Resources\MatchDetails\MatchResource;
use App\Http\Resources\MatchDetails\PreviewResource;
use App\Http\Resources\StreamResource;
use App\Models\GtMatchList;
use App\Services\DictionaryService;
use App\Services\MatchService;
use App\Services\StreamService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MatchShowController extends Controller
{
    private MatchService $matchService;
    private StreamService $streamService;
    private DictionaryService $dictService;

    public function __construct(
        MatchService      $matchService,
        StreamService     $streamService,
        DictionaryService $dictService)
    {
        $this->matchService = $matchService;
        $this->streamService = $streamService;
        $this->dictService = $dictService;
    }

    public function show(Request $request)
    {
        $id = intval($request->id);
        $game = $request->game;

        $lang = $request->language;

        $match = new MatchResource(
            $this->matchService->show($id, $request->get('num'))
        );

        $history = $this->matchService->getHistory($id);

        $streams = StreamResource::collection($this->streamService->getListForMatch($id));

        $heroes = $this->dictService->getHeroes($game);

        $t1 = $match->getTeam1();
        $t2 = $match->getTeam2();
        $t1->setPlayers($this->matchService->sortPlayersDeskByNetWorth($t1->getPlayers()));
        $t2->setPlayers($this->matchService->sortPlayersDeskByNetWorth($t2->getPlayers()));

        $isLive = $match->getStatus() == 1 || $match->getWinner();

        $hasPicks = $t1->getPicks() && $t2->getPicks();
        $hasBans = $t1->getBans() && $t2->getBans();

        $jsonDataBuildings = file_get_contents("json/dota-2-maps.json");
        $buildings = json_decode($jsonDataBuildings);

        $game = $match->getGameId()  == 582 ? 'dota-2' : 'lol';

        return view('match', [
            'lang' => $lang,
            'game' => $game,
            'history' => new HistoryResource($history),
            'buildings' => $buildings,
            'match_id' => $id,
            'streams' => $streams,
            'hasPicks' => $hasPicks,
            'hasBans' => $hasBans,
            'heroes' => $heroes,
            'biggestNet' => $this->matchService->biggestNetMatch($t1->getPlayers(), $t2->getPlayers()),
            'isLive' => $isLive,
            'match' => $match,
        ]);
    }


    public function sendWebSocketData(Request $request, int $id)
    {
        $match = new MatchResource(
            $this->matchService->show($id, $request->get('num'))
        );


        $heroes = $this->dictService->getHeroes("dota-2");

        $match->getTeam1()->setPlayers($this->matchService->sortPlayersDeskByNetWorth($match->getTeam1()->getPlayers()));
        $match->getTeam2()->setPlayers($this->matchService->sortPlayersDeskByNetWorth($match->getTeam2()->getPlayers()));

        $isLive = $match->getStatus() == 1 && !$match->getWinner();

        $hasPicks = $match->getTeam1()->getPicks() && $match->getTeam2()->getPicks();
        $hasBans = $match->getTeam1()->getBans() && $match->getTeam2()->getBans();

        event(new MatchDataUpdate($id, [
            'hasPicks' => $hasPicks,
            'hasBans' => $hasBans,
            'heroes' => $heroes,
            'biggestNet' => $this->matchService->biggestNetMatch($match->getTeam1()->getPlayers(), $match->getTeam2()->getPlayers()),
            'isLive' => $isLive,
            'match' => $match,
        ]));
    }
}
