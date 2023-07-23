<?php

namespace App\Http\Requests;

use App\Repositories\Eloquent\CurrencyRepository;
use Illuminate\Validation\Rule;

class CurrencyRequest extends Request
{
    protected $stopOnFirstFailure = true;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param CurrencyRepository $currencyRepository
     * @return array[]
     */
    public function rules(CurrencyRepository $currencyRepository): array
    {
        return [
            'currency' => [
                'required',
                'string',
                Rule::in($currencyRepository->getAllCode()),
            ],
            'date' => [
                'nullable',
                'string',
            ],
        ];
    }
}
