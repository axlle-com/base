<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdatePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

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
