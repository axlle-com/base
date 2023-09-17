<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;

class AuthAjaxController extends AjaxController
{
    private UserServices $userServices;

    /**
     * @param UserServices $userServices
     */
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if ($this->userServices->login($request->all())) {
            return $this->response([
                'redirect' => RouteServiceProvider::ADMIN_HOME
            ]);
        }

        return $this->setMessage('Не правильный логин или пароль')->error();
    }
}
