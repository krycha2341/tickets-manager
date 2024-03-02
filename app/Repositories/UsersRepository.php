<?php

namespace App\Repositories;

use App\DataTransferObjects\CreateUserDTO;
use App\Exceptions\UserNotFoundException;
use App\ValueObjects\UserVO;

interface UsersRepository
{
    public function create(CreateUserDTO $dto): UserVO;

    /**
     * @throws UserNotFoundException
     */
    public function get(int $id): UserVO;

    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): UserVO;

    public function getUserToken(int $id): string;
}
