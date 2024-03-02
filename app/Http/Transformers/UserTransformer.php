<?php

namespace App\Http\Transformers;

use App\ValueObjects\UserVO;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(UserVO $userVO): array
    {
        return [
            'id' => $userVO->getId(),
            'name' => $userVO->getName(),
            'email' => $userVO->getEmail(),
            'email_verified_at' => $userVO->getEmailVerifiedAt()?->toDateTimeString(),
            'created_at' => $userVO->getCreatedAt()->toDateTimeString(),
            'updated_at' => $userVO->getUpdatedAt()->toDateTimeString(),
        ];
    }
}
