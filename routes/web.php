<?php


use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MatchShowController;
use App\Http\Controllers\SeoController;
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


Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/{id}', [MatchShowController::class, 'index'])->name("match-index");;
    Route::post('/{id}', [MatchShowController::class, 'index'])->name("match-post-index");
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{block}', [ArticleController::class, 'show']);
});
