<?php

use Illuminate\Contracts\Cache\Lock;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('jenkins', function () {
    return 'jenkins';
});

route::get('db', function () {
    return DB::table('articles')
        ->select(['id', 'title'])
        ->latest()->get();
});

Route::get('cache', function (Request $request) {
    $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    $left = 0;

    $right = count($ids);

    $x = 6;


    for ($i = $left; $i <= $right; $i++) {

        $mid = ($left + $right) / 2;

        if ($ids[$mid] == $x) {
            return 'index :' . $mid;
        }

        if ($ids[$mid] > $x) {
            $right =  $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
});

Route::get('loop', function () {
    $loop = React\EventLoop\Factory::create();

    $loop->addTimer(1, function () {
        echo 'world!' . PHP_EOL;
    });

    $loop->addTimer(0.3, function () {
        echo 'hello ';
    });

    $loop->run();
});

Route::get('get-profile', function (Request $request) {

    //  Cache::put('count_request', 0, 600);
    $keyRequest = 'count_request';

    if (Cache::has($keyRequest)) {
        $count  = Cache::get($keyRequest);

        if ($count == 3) {
            Cache::put($keyRequest, 1, 600);

            return response()->json([
                'data' => 'ok',
                'code' => 200
            ], 200);
        } else {

            Cache::put($keyRequest, $count = $count + 1, 600);

            return response()->json([
                'data' => 'failed',
                'code' => 500
            ], 500);
        }
    } else {

        Cache::put($keyRequest, 1, 600);

        return response()->json([
            'data' => 'failed',
            'code' => 500
        ], 500);
    }
});

    
Route::get('providers', function () {
    $keyName = 'fpt_35';
    return Cache::get($keyName);
})->name('heyenglish_providers');
