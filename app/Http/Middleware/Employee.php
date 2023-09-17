<?php

namespace App\Http\Middleware;

use App\Models\Rights\Helper\Permission;
use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;

class Employee
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::auth();
        if ($user && in_array(Permission::ENTRY_ALLOWED, $user->getSessionPermissions(), true)) {
            return $next($request);
        }
        abort(404);
    }
}
