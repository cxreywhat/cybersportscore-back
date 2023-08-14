<?php


use App\Http\Controllers\BannerController;
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

Route::get('/', function () {
        return view('home');
    });

Route::get('/news', function () {
    return view('newsList');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/translit', function () {
        return view('newsArticle');
    });
});

Route::get('/match', function () {
    return view('match');
});
