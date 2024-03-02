<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Logout extends Controller
{
    public function __construct(readonly private UsersService $usersService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->usersService->logout();

        return $this->emptyResponse();
    }
}
