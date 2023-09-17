<?php

namespace App\Services;

use App\Models\User\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    private IUserRepository $userRepo;

    /**
     * @param IUserRepository $userRepo
     */
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param array $attributes
     * @return false
     */
    public function login(array $attributes): bool
    {
        /** @var User $user */
        if (
            ($user = $this->userRepo->findByAttributes(['email' => $attributes['email']]))
            && Hash::check($attributes['password'], $user->password_hash)
            && Auth::loginUsingId($user->id, $attributes['remember'])
        ) {
            $user->setSessionRoles();

            return true;
        }

        return false;
    }

}
