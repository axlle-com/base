<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\CurrencyFiltersDTO;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Services\Currency\CurrencyServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class CurrencyController extends ApiController
{
    /**
     * @param CurrencyServices $currencyServices
     * @return JsonResponse
     */
    public function index(CurrencyServices $currencyServices): JsonResponse
    {
        return $this->response(CurrencyResource::collection($currencyServices->getAllCurrency()));
    }

    /**
     * @param CurrencyRequest $currencyRequest
     * @param CurrencyServices $currencyServices
     * @return JsonResponse
     * @throws ValidationException
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function currencyExchangeRate(
        CurrencyRequest  $currencyRequest,
        CurrencyServices $currencyServices
    ): JsonResponse
    {
        return $this->response(
            $currencyServices->getExchangeRateForFilter(
                CurrencyFiltersDTO::fromRequest($currencyRequest)
            )?->toArray()
        );
    }
}
