<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rules\Password;

class SyncExternalUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => [
                'string',
                'filled',
                Password::min(8)->letters()->numbers()->mixedCase(),
            ]
        ];
    }
}
