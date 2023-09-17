<?php

namespace App\Repositories\Eloquent;

use App\Models\User\User;
use App\Repositories\Interfaces\IUserRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
