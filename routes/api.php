<?php

use App\Http\Controllers\Users\Login;
use App\Http\Controllers\Users\Logout;
use App\Http\Controllers\Users\SyncExternalUser;
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
