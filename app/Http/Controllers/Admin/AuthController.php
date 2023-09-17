<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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

    public function login()
    {
        return view('admin.auth.login');
    }
}
