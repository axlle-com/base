<?php

namespace App\Models;

/**
 * Class History
 *
 * @property int $id
 * @property int|null $ips_id
 * @property int|null $user_id
 * @property string $resource
 * @property int $resource_id
 * @property string $event
 * @property string|null $body
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Ip|null $ip
 * @property User|null $user
 *
 * @package App\Models
 */
class History extends BaseModel
{
	protected $table = 'history';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'ips_id' => 'int',
		'user_id' => 'int',
		'resource_id' => 'int'
	];

	protected $fillable = [
		'ips_id',
		'user_id',
		'resource',
		'resource_id',
		'event',
		'body',
		'description'
	];

	public function ip()
	{
		return $this->belongsTo(Ip::class, 'ips_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
