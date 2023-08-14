<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchesRequest;
use App\Http\Resources\MatchList\MatchListResource;
use App\Services\MatchService;
use Illuminate\Contracts\Support\Responsable;

class HomeController extends Controller
{
    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index(MatchesRequest $request)
    {
        $data = MatchListResource::collection(
            $this->matchService->getList($request->validated())
        ) ;

        return view('home', [
            'items' => $data
        ]);
    }
}
