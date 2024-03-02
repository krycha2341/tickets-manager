<?php

declare(strict_types=1);

namespace App\Services\External\UserProvider;

use App\DataTransferObjects\ExternalUserDTO;

interface UserProviderServiceInterface
{
    public function getUser(string $id): ExternalUserDTO;
}
