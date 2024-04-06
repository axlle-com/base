<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AuthController extends Controller
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
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function loginForm()
    {
        $user = User::auth();
        if ($user) {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }
        return view('admin.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return Application|Factory|\Illuminate\Foundation\Application|Redirector|RedirectResponse|View
     */
    public function login(LoginRequest $request)
    {
        if ($this->userServices->login($request->all())) {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }
        return view('admin.auth.login');
    }
}
