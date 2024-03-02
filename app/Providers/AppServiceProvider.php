<?php

namespace App\Providers;

use App\Repositories\Implementations\EloquentTasksRepository;
use App\Repositories\Implementations\EloquentUsersRepository;
use App\Repositories\TasksRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UsersRepository::class,
            EloquentUsersRepository::class
        );
        $this->app->bind(
            TasksRepository::class,
            EloquentTasksRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
