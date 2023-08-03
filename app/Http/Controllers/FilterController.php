<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Filters\TeamResource;
use App\Http\Resources\Filters\TournamentResource;
use App\Services\TournamentService;
use App\Services\TeamService;
use Dmp\Services\SearchServices\SearchInterface as Search;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function tournaments(Request $request, TournamentService $service, Search $search): Responsable
    {
        return TournamentResource::collection(
            $service->getFilterItems($search, [
                'game_id' => $request->get('game_id'),
                'search' => $request->get('search'),
                'event_eng' => $request->get('event_eng'),
            ])
        );
    }

    public function teams(Request $request, TeamService $service, Search $search): Responsable
    {
        return TeamResource::collection(
            $service->getFilterItems($search, [
                'game_id' => $request->get('game_id'),
                'search' => $request->get('search'),
                'team_eng' => $request->get('team_eng'),
            ])
        );
    }
}
