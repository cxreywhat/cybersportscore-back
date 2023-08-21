<?php

namespace App\Http\Controllers;

use App\Enums\GamesType;
use App\Http\Resources\MatchDetails\HistoryBlockResource;
use App\Http\Resources\MatchDetails\HistoryResource;
use App\Http\Resources\MatchDetails\PreviewResource;
use App\Models\GtMatchList;
use App\Services\MatchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatchShowController extends Controller
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
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

        $matchLogs = GtMatchList::query()
            ->with([
                'match',
                'matchGames'
            ])
            ->find($id);



        $logs = response()->json();

        if ($matchLogs) {
            $logs = response()->json($this->matchService->buildGameLogs($matchLogs, 2));
        }

        $match = response()->json($dataMatch);
        $history = new HistoryResource($this->matchService->getHistory($id, $side));
        $preview = new PreviewResource($this->matchService->preview($id));

        return view('match', [
            'match_beta' => $match->getData(),
            'history' => $history,
            'preview' => $preview,
            'logs' => $logs
        ]);
    }
}
