<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Exceptions\PasswordMissingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SyncExternalUserRequest;
use App\Http\Transformers\UserTransformer;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;

class SyncExternalUser extends Controller
{
    public function __construct(readonly private UsersService $usersService)
    {
    }

    /**
     * @throws PasswordMissingException
     */
    public function __invoke(string $id, SyncExternalUserRequest $request): JsonResponse
    {
        $userVo = $this->usersService->syncExternalUser(
            $id,
            $request->get('password')
        );

        return $this->itemResponse($userVo, new UserTransformer());
    }
}
