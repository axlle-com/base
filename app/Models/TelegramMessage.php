<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class TelegramMessage
 *
 * @property int $id
 * @property int|null $telegram_message_id
 * @property int|null $telegram_user_id
 * @property int $message_id
 * @property int|null $update_id
 * @property string|null $text
 * @property string|null $search
 * @property int|null $date
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $deleted_at
 *
 * @property TelegramMessage|null $telegramMessage
 * @property TelegramUser|null $telegramUser
 * @property Collection|TelegramMessage[] $telegramMessages
 *
 * @package App\Models
 */
class TelegramMessage extends BaseModel
{
	protected $table = 'telegram_message';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'telegram_message_id' => 'int',
		'telegram_user_id' => 'int',
		'message_id' => 'int',
		'update_id' => 'int',
		'date' => 'int'
	];

	protected $fillable = [
		'telegram_message_id',
		'telegram_user_id',
		'message_id',
		'update_id',
		'text',
		'search',
		'date'
	];

	public function telegramMessage()
	{
		return $this->belongsTo(TelegramMessage::class);
	}

	public function telegramUser()
	{
		return $this->belongsTo(TelegramUser::class);
	}

	public function telegramMessages()
	{
		return $this->hasMany(TelegramMessage::class);
	}
}
