<?php

namespace App\Services;

use App\DataTransferObjects\CreateUserDTO;
use App\DataTransferObjects\LoginDTO;
use App\Exceptions\AuthenticationException;
use App\Exceptions\PasswordMissingException;
use App\Models\User;
use App\Repositories\UsersRepository;
use App\Services\External\UserProvider\UserProviderServiceFactory;
use App\Services\External\UserProvider\UserProviderServiceInterface;
use App\ValueObjects\UserVO;
use Illuminate\Support\Facades\Auth;

readonly class UsersService
{
    private UserProviderServiceInterface $userProviderService;

    public function __construct(
        private UsersRepository $usersRepository,
        UserProviderServiceFactory $factory
    ) {
        $this->userProviderService = $factory->make();
    }

    /**
     * @throws AuthenticationException
     */
    public function login(LoginDTO $dto): string
    {
        $credentials = [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ];
        if (Auth::attempt($credentials)) {
            /** @var User $user */
            $user = Auth::user();

            return $user->createToken($user->email)->plainTextToken;
        }

        throw new AuthenticationException();
    }

    /**
     * @throws PasswordMissingException
     */
    public function syncExternalUser(
        string $externalUserId,
        ?string $password = null
    ): UserVO {
        $externalUser = $this->userProviderService->getUser($externalUserId);
        $password = $password ?? $externalUser->getPassword();
        if ($password === null) {
            throw new PasswordMissingException();
        }

        $userData = new CreateUserDTO(
            sprintf('%s %s', $externalUser->getFirstName(), $externalUser->getLastName()),
            $externalUser->getEmail(),
            $password
        );

        return $this->usersRepository->create($userData);
    }

    public function logout(): void
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
