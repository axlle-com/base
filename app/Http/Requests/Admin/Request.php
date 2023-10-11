<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class Request extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 0,
                'data' => null,
                'message' => '',
                'errors' => $validator->errors()->getMessages(),
            ])
        );
    }

}
