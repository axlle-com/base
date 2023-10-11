<?php

namespace App\Http\Requests\Admin\Post;

use App\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdatePostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
