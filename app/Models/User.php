<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $is_email
 * @property int|null $is_phone
 * @property int $status
 * @property string|null $avatar
 * @property string $password_hash
 * @property string|null $remember_token
 * @property string|null $auth_key
 * @property string|null $password_reset_token
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|History[] $histories
 * @property Collection|Logger[] $loggers
 * @property Collection|TelegramUser[] $telegramUsers
 * @property Collection|UserToken[] $userTokens
 *
 * @package App\Models
 */
class User extends BaseModel
{
	protected $table = 'user';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'is_email' => 'int',
		'is_phone' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'remember_token',
		'password_reset_token'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'patronymic',
		'phone',
		'email',
		'is_email',
		'is_phone',
		'status',
		'avatar',
		'password_hash',
		'remember_token',
		'auth_key',
		'password_reset_token'
	];

	public function histories()
	{
		return $this->hasMany(History::class);
	}

	public function loggers()
	{
		return $this->hasMany(Logger::class);
	}

	public function telegramUsers()
	{
		return $this->hasMany(TelegramUser::class);
	}

	public function userTokens()
	{
		return $this->hasMany(UserToken::class);
	}
}
