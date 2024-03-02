<?php

namespace App\Http\Requests\Tasks;

use App\Http\Requests\FormRequest;

class ListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['filled', 'integer'],
            'offset' => ['filled', 'integer'],
            'user_id' => ['filled', 'integer'],
        ];
    }
}
