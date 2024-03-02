<?php

namespace App\Http\Controllers\Users;

use App\DataTransferObjects\LoginDTO;
use App\Http\Controllers\Controller;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function __construct(readonly private UsersService $usersService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $token = $this->usersService->login(new LoginDTO(
            $request->get('email'),
            $request->get('password')
        ));
        $request->session()->regenerateToken();

        return response()->json(['token' => $token]);
    }
}
