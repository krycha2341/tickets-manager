<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatus;
use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'user_id' => ['filled', 'integer'],
            'status' => ['required', Rule::in(TaskStatus::values())]
        ];
    }
}
