<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * Class UserGuest
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class UserGuest extends BaseModel
{
    protected $table = 'user_guest';

    protected $fillable = [
        'email',
        'name'
    ];
}
