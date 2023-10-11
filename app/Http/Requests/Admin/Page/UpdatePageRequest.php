<?php

namespace App\Http\Requests\Admin\Page;

use App\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdatePageRequest extends Request
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
