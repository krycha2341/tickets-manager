<?php

use App\Http\Controllers\Tasks\CreateTask;
use App\Http\Controllers\Tasks\DeleteTask;
use App\Http\Controllers\Tasks\GetTask;
use App\Http\Controllers\Tasks\ListTasks;
use App\Http\Controllers\Tasks\UpdateTask;
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
    'namespace' => '\\',
], function () {
    Route::post('external/{id}/sync', SyncExternalUser::class);
    Route::post('login', Login::class);

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::post('logout', Logout::class);
    });
});

Route::group([
    'prefix' => 'tasks',
    'namespace' => '\\',
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('', CreateTask::class);
    Route::get('', ListTasks::class);
    Route::get('{id}', GetTask::class);
    Route::put('{id}', UpdateTask::class);
    Route::delete('{id}', DeleteTask::class);
});
