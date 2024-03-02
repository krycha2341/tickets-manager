<?php

namespace App\Repositories;

use App\DataTransferObjects\CreateUserDTO;
use App\ValueObjects\UserVO;

interface UsersRepository
{
    public function create(CreateUserDTO $dto): UserVO;

    public function get(int $id): UserVO;

    public function getByEmail(string $email): UserVO;

    public function getUserToken(int $id): string;
}
