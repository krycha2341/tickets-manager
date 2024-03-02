<?php

declare(strict_types=1);

namespace App\Services\External\UserProvider;

use App\Services\External\UserProvider\DummyAPI\UsersServiceClient;

class UserProviderServiceFactory
{
    public function make(): UserProviderServiceInterface
    {
        return match (true) {
            default => app()->make(UsersServiceClient::class),
        };
    }
}
