<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequestParent;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class FormRequest extends FormRequestParent
{
    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'status' => '422',
            'errors' => $validator->errors(),
        ], 422));
    }
}
