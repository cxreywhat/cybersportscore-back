<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MatchShowController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\WebsocketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enums\GameEnum as Game;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/config', [WebsocketController::class, 'getEchoConfig']);

Route::middleware(['cors'])->group(function () {
    Route::group(['prefix' => 'filters'], function () {
        Route::get('tournaments', [FilterController::class, 'tournaments']);
        Route::get('teams', [FilterController::class, 'teams']);
    });

    Route::get('matches/{id}/preview', [MatchController::class, 'showPreview'])
        ->name('matches.show-preview');

    Route::apiResource('matches', MatchController::class)
        ->only(['index', 'show']);

    Route::get('matches/{id}/streams', [StreamController::class, 'index'])
        ->name('matches.streams');

    Route::get('matches/{id}/history/{side?}', [MatchController::class, 'showHistory'])
        ->whereIn('side', ['t1', 't2', 'common'])
        ->name('matches.show-history');

    Route::group(['prefix' => 'beta/matches'], function () {
        Route::get('/', [MatchController::class, 'matchesBeta']);
        Route::get('/{id}', [MatchController::class, 'matchBeta']);
    });

    Route::get('matches-by-team', [MatchController::class, 'matchesByTeam']);
    Route::get('tournaments', [MatchController::class, 'tournaments']);
    Route::get('teams', [MatchController::class, 'teams']);
    Route::get('logs/{id}/{num}', [MatchController::class, 'getGameLogs']);

    Route::get('news', [NewsController::class, 'index']);
    Route::get('news/{id}', [NewsController::class, 'show']);

    Route::get('banners', [BannerController::class, 'banners']);

    Route::get('streams', [StreamController::class, 'streams']);

    Route::group(['prefix' => '{eng}'], function () {
        Route::get('heroes', [DictionaryController::class, 'heroes']);
    })->whereIn('eng', [Game::DOTA2->eng(), Game::LOL->eng()]);

    Route::get('sitemap/{sitemap}', [SeoController::class, 'sitemap']);
});


Route::get('articlesBlock', [ArticleController::class, 'articlesBlock']);

Route::get('{id}', [MatchShowController::class, 'sendWebSocketData'])
    ->where('id', '[0-9]+');

