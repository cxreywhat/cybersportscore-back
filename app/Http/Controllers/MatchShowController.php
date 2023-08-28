<?php

namespace App\Http\Controllers;

use App\Enums\GamesType;
use App\Events\MatchDataUpdate;
use App\Http\Resources\MatchDetails\HistoryResource;
use App\Http\Resources\MatchDetails\PreviewResource;
use App\Http\Resources\StreamResource;
use App\Models\GtMatchList;
use App\Services\MatchService;
use App\Services\StreamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchShowController extends Controller
{
    private MatchService $matchService;
    private StreamService $streamService;

    private $match;
    private $preview;
    private $numGame;

    public function __construct(MatchService $matchService, StreamService $streamService)
    {
        $this->matchService = $matchService;
        $this->streamService = $streamService;
    }

    public function index(Request $request, int $id, ?string $side = null)
    {
        $dataMatch = GtMatchList::query()
            ->with([
                'match',
                'matchGames',
                'matchDotaLiveGame' => function ($q) {
                    $q
                        ->with('dotaEvents')
                        ->whereHas('matchList', function ($q) {
                            $q->where('gt_match_list.game_id', GamesType::DOTA2->broadcast());
                        });
                },
                'matchLolLiveGame' => function ($q) {
                    $q
                        ->whereHas('matchList', function ($q) {
                            $q->where('gt_match_list.game_id', GamesType::LOL->broadcast());
                        });
                }
            ])
            ->find($id);

        if ($dataMatch) {
            $this->matchService->liveMatchBuilder($dataMatch);
            $this->matchService->offlineMatchBuilder($dataMatch);
        };

        $streams = StreamResource::collection($this->streamService->getListForMatch($id));
        $this->match = response()->json($dataMatch);
        $history = new HistoryResource($this->matchService->getHistory($id, $side));
        $this->preview = new PreviewResource($this->matchService->preview($id));
        $this->numGame = intval($request->input('num')) > 0
            ? intval($request->input('num'))
            : $this->preview->getNum();

        return view('match', [
            'match_beta' => $this->match->getData(),
            'streams' => $streams,
            'history' => $history,
            'num_game' => $this->numGame,
            'preview' => $this->preview
        ]);
    }

    public function sendWebSocketData(Request $request, int $id)
    {
        $i = 0;
        while($i != 5)
        {
            $i++;
            $dataMatch = GtMatchList::query()
                ->with([
                    'match',
                    'matchGames',
                    'matchDotaLiveGame' => function ($q) {
                        $q
                            ->with('dotaEvents')
                            ->whereHas('matchList', function ($q) {
                                $q->where('gt_match_list.game_id', GamesType::DOTA2->broadcast());
                            });
                    },
                    'matchLolLiveGame' => function ($q) {
                        $q
                            ->whereHas('matchList', function ($q) {
                                $q->where('gt_match_list.game_id', GamesType::LOL->broadcast());
                            });
                    }
                ])
                ->find($id);

            if ($dataMatch) {
                $this->matchService->liveMatchBuilder($dataMatch);
                $this->matchService->offlineMatchBuilder($dataMatch);
            };

            $this->match = response()->json($dataMatch);
            $this->preview = new PreviewResource($this->matchService->preview($id));
            $this->numGame = intval($request->input('num')) > 0
                ? intval($request->input('num'))
                : $this->preview->getNum();

            event(new MatchDataUpdate($id, [
                'match_beta' => $this->match->getData(),
                'num_game' => $this->numGame,
                'preview' => $this->preview
            ]));
            sleep(2);
        }
    }
}
