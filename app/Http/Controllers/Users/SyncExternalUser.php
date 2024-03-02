<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SyncExternalUser extends Controller
{
    public function __construct(readonly private UsersService $usersService)
    {
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        $userVo = $this->usersService->syncExternalUser($id, $request->get('password'));

        return $this->itemResponse($userVo, new UserTransformer());
    }
}
