<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function response(mixed $data): JsonResponse
    {
        return response()->json(
            [
                'status' => 1,
                'data' => $data,
                'errors' => null,
            ]
        );
    }
}
