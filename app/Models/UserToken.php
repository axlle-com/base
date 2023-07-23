<?php

namespace App\Models;

/**
 * Class UserToken
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $type
 * @property string $token
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $expired_at
 *
 * @property User|null $user
 *
 * @package App\Models
 */
class UserToken extends BaseModel
{
	protected $table = 'user_token';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int',
		'expired_at' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'user_id',
		'type',
		'token',
		'expired_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
