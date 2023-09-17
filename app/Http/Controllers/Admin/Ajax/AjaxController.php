<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class AjaxController extends Controller
{
    private int $status = 1;
    private mixed $data = null;
    private mixed $errors = null;
    private ?string $message = null;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function response(mixed $data = null): JsonResponse
    {
        return response()->json(
            [
                'status' => $this->status,
                'data' => $data ?? $this->data,
                'message' => $this->message,
                'errors' => $this->errors,
            ]
        );
    }

    public function error(mixed $errors = null): JsonResponse
    {
        return response()->json(
            [
                'status' => 0,
                'message' => $this->message,
                'data' => $this->data,
                'errors' => $errors ?? $this->errors,
            ],419
        );
    }

    /**
     * @param int $status
     * @return AjaxController
     */
    public function setStatus(int $status): AjaxController
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $data
     * @return AjaxController
     */
    public function setData(mixed $data): AjaxController
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param mixed $errors
     * @return AjaxController
     */
    public function setErrors(mixed $errors): AjaxController
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @param string|null $message
     * @return AjaxController
     */
    public function setMessage(?string $message): AjaxController
    {
        $this->message = $message;
        return $this;
    }


}
