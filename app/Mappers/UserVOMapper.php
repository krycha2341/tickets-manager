<?php

namespace App\Mappers;

use App\Models\User;
use App\ValueObjects\UserVO;

class UserVOMapper
{
    public function fromEloquentModel(User $user): UserVO
    {
        return new UserVO(
            $user->id,
            $user->name,
            $user->email,
            $user->email_verified_at,
            $user->created_at,
            $user->updated_at
        );
    }
}
