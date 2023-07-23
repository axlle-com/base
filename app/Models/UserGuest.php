<?php

namespace App\Models;

/**
 * Class UserGuest
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class UserGuest extends BaseModel
{
	protected $table = 'user_guest';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'email',
		'name'
	];
}
