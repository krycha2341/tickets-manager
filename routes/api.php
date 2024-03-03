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
    Route::post('external/{id}/sync', SyncExternalUser::class)
        ->whereAlphaNumeric('id')
        ->name('users.sync');
    Route::post('login', Login::class)->name('users.login');

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::post('logout', Logout::class)->name('users.logout');
    });
});

Route::group([
    'prefix' => 'tasks',
    'namespace' => '\\',
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('', CreateTask::class)->name('tasks.create');
    Route::get('', ListTasks::class)->name('tasks.list');
    Route::get('{id}', GetTask::class)
        ->whereNumber('id')
        ->name('tasks.get');
    Route::put('{id}', UpdateTask::class)
        ->whereNumber('id')
        ->name('tasks.update');
    Route::delete('{id}', DeleteTask::class)
        ->whereNumber('id')
        ->name('tasks.delete');
});
