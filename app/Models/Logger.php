<?php

namespace App\Models;

use App\Models\User\User;

/**
 * Class Logger
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $ip_id
 * @property string $uuid
 * @property string $channel
 * @property string $level
 * @property string $title
 * @property string|null $body
 * @property float $created_at
 * @property string $created_date
 *
 * @property Ip|null $ip
 * @property User|null $user
 *
 * @package App\Models
 */
class Logger extends BaseModel
{
	protected $table = 'logger';

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'ip_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'ip_id',
		'uuid',
		'channel',
		'level',
		'title',
		'body',
		'created_date'
	];

	public function ip()
	{
		return $this->belongsTo(Ip::class, 'ip_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
