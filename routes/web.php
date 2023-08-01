<?php

use Illuminate\Contracts\Cache\Lock;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Request;

use App\Http\Controllers\DesignPattern;
use App\Http\Controllers\ZaloController;
use App\Http\Controllers\ModelController;

use Illuminate\Support\Facades\Validator;

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





Route::get('storage',   function (Request $request) {

    $validator = Validator::make($request->all(), [
        'name' => 'string|max:3|upercase'
    ]);

    return $validator->errors();

    // return Storage::disk('public')->put('files/report-01.txt', 'content');
});

Route::get('cache-page', function () {
    return 'done';
});


Route::get('singleton', [DesignPattern::class, 'singleton']);

Route::get('factory', [DesignPattern::class, 'factory']);

Route::get('builder', [DesignPattern::class, 'builder']);

Route::get('adapter', [DesignPattern::class, 'adapter']);

Route::get('facade', [DesignPattern::class, 'facade']);

Route::get('strategy', [DesignPattern::class, 'strategy']);

Route::get('proxy', [DesignPattern::class, 'proxy']);

Route::get('chat', [DesignPattern::class, 'chat']);

Route::get('zalo/login', [ZaloController::class, 'login']);

Route::get('zalo/block', [ZaloController::class, 'block']);


Route::get('placeholder/{id}', function ($id) {
    $users = [
        [
            'userId' => 1,
            'id' => 1,
            'title' => 'delectus aut autem 1'
        ],
        [
            'userId' => 2,
            'id' => 2,
            'title' => 'delectus aut autem 2'
        ],
        [
            'userId' => 3,
            'id' => 3,
            'title' => 'delectus aut autem 3'
        ],
        [
            'userId' => 4,
            'id' => 4,
            'title' => 'delectus aut autem 4'
        ]
    ];

    $user =  array_filter($users, function ($item)  use ($id) {
        return $item['id'] == $id;
    });

    header('Access-Control-Allow-Origin : *');

    return array_values($user)[0];
});

Route::get('client', function () {
    sleep(2);
    return response()
        ->json([
            [
                "userId" => 1,
                "id" => 1,
                "title" =>  "delectus aut autem",
                "completed" => false
            ],
            [
                "userId" => 1,
                "id" => 2,
                "title" => "quis ut nam facilis et officia qui",
                "completed" => false
            ]
        ])
        ->header('Access-Control-Allow-Origin', '*');
});

Route::get('validate', [ZaloController::class, 'form']);

Route::get('model', [ModelController::class, 'index']);

Route::get('create', [ModelController::class, 'create']);

Route::get('user', [\App\Http\Controllers\UserController::class, 'index']);
