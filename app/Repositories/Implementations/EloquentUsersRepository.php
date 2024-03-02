<?php

declare(strict_types=1);

namespace App\Repositories\Implementations;

use App\DataTransferObjects\CreateUserDTO;
use App\Exceptions\UserNotFoundException;
use App\Mappers\UserVOMapper;
use App\Models\User;
use App\Repositories\UsersRepository;
use App\ValueObjects\UserVO;
use Illuminate\Database\Eloquent\ModelNotFoundException;

readonly class EloquentUsersRepository implements UsersRepository
{
    public function __construct(private UserVOMapper $userVOMapper)
    {
    }

    public function create(CreateUserDTO $dto): UserVO
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ]);

        return $this->userVOMapper->fromEloquentModel($user);
    }

    public function get(int $id): UserVO
    {
        /** @var User $user */
        $user = User::query()->where('id', $id)->first();
        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $this->userVOMapper->fromEloquentModel($user);
    }

    public function getByEmail(string $email): UserVO
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();
        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $this->userVOMapper->fromEloquentModel($user);
    }

    public function getUserToken(int $id): string
    {
        /** @var User $user */
        $user = User::query()->where('id', $id)->first();
        if ($user === null) {
            throw new ModelNotFoundException();
        }

        return '';
    }
}
