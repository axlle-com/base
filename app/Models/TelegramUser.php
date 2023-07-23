<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class TelegramUser
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string|null $type
 * @property string|null $language_code
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $deleted_at
 *
 * @property User|null $user
 * @property Collection|TelegramMessage[] $telegramMessages
 *
 * @package App\Models
 */
class TelegramUser extends BaseModel
{
	protected $table = 'telegram_user';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'first_name',
		'last_name',
		'username',
		'type',
		'language_code'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function telegramMessages()
	{
		return $this->hasMany(TelegramMessage::class);
	}
}
