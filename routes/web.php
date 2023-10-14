<?php


use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MatchShowController;
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


Route::group(['prefix' => 'news'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{block}', [ArticleController::class, 'show']);
});

Route::group(['prefix' => '/'], function () {
    Route::get('', [HomeController::class, 'index'])->name('match');

    Route::get('{id}', [MatchShowController::class, 'show'])
        ->where('id', '[0-9]+')
        ->name("match-index");
});

Route::get('loaderData', [HomeController::class, 'loader']);

Route::match(['get', 'post'],'/match/details', [HomeController::class, 'details']);

Route::get('/matchesData', [HomeController::class, 'sendData']);
Route::get('/matchDetails', [HomeController::class, 'sendDataDetailsMatch']);
Route::get('/articlesBlock', [ArticleController::class, 'articlesBlock']);

