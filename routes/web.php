<?php

use App\Livewire\Pornstars\Board;
use App\Livewire\Pornstars\View;
use App\Models\Orientation;
use App\Services\JsonParserService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Board::class)->name('pornstars.board');
Route::get('/pornstars/{name}', View::class)->name('pornstars.view');

Route::get('/test', function () {
    $jps = new JsonParserService();
    // $hc = $jps->downloadFeed('https://www.pornhub.com/files/json_feed_pornstars.json');
    // $jps->updateTypes();

    echo '<pre>';
    print_r($jps->parsePornstars());
    echo '</pre>';
});