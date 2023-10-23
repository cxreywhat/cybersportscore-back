<?php


use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MatchShowController;
use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('go', [BannerController::class, 'go']);

//Route::get('/', function () {
//    return view('go', [
//        'url' => 'https://betboom.ru/sport/EventView/11347666#events/11347666/11347666#events/11347666/11347666#events/11347666/11347666#events/11347666/11347666#events/11347666'
//    ]);
//});




Route::middleware(['language'])->group(function () {
    Route::get('/blog', [ArticleController::class, 'index'])
        ->where('language', 'en')
        ->name('blog.index');
    Route::get('/{language?}/blog', [ArticleController::class, 'index']);
    Route::get('/{language?}/blog/{block}', [ArticleController::class, 'show']);

    Route::group(['prefix' => '/'], function () {
        Route::get('/{language?}/{game?}', [HomeController::class, 'index'])
            ->where('game', 'dota-2|lol')
            ->name('match');

        Route::get('/{language?}/{game}/{id}', [MatchShowController::class, 'show'])
            ->where('game', 'dota-2|lol')
            ->where('id', '[0-9]+')
            ->name("game-id");

        Route::get('/{game}/{id}', [MatchShowController::class, 'show'])
            ->where('game', 'dota-2|lol')
            ->where('id', '[0-9]+')
            ->name("game-id");
    });
});


Route::get('loaderData', [HomeController::class, 'loader']);
Route::match(['get', 'post'],'/match/details', [HomeController::class, 'details']);
Route::get('/matchesData', [HomeController::class, 'sendData']);
Route::get('/matchDetails', [HomeController::class, 'sendDataDetailsMatch']);

