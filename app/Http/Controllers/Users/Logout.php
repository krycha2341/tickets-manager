<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;

class Logout extends Controller
{
    public function __construct(readonly private UsersService $usersService)
    {
    }

    public function __invoke(): JsonResponse
    {
        $this->usersService->logout();

        return $this->emptyResponse();
    }
}
