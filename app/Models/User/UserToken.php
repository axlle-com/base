<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * Class UserToken
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $type
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Carbon|null $expired_at
 *
 * @property User|null $user
 *
 * @package App\Models
 */
class UserToken extends BaseModel
{
	protected $table = 'user_token';

	protected $casts = [
		'user_id' => 'int',
		'expired_at' => 'datetime'
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
