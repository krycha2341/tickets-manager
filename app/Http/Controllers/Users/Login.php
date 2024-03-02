<?php

namespace App\Http\Controllers\Users;

use App\DataTransferObjects\LoginDTO;
use App\Exceptions\AuthenticationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function __construct(readonly private UsersService $usersService)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $token = $this->usersService->login(new LoginDTO(
            $request->get('email'),
            $request->get('password')
        ));

        return response()->json(['token' => $token]);
    }
}
