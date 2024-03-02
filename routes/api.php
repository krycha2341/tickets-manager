<?php

use App\Http\Controllers\Users\Login;
use App\Http\Controllers\Users\Logout;
use App\Http\Controllers\Users\SyncExternalUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'users',
    'namespace' => '\\'
], function () {
    Route::post('external/{id}/sync', SyncExternalUser::class);
    Route::post('login', Login::class);

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::post('logout', Logout::class);
    });
});
