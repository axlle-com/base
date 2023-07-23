<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Ip
 *
 * @property int $id
 * @property string $ip
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|History[] $histories
 * @property Collection|Logger[] $loggers
 *
 * @package App\Models
 */
class Ip extends BaseModel
{
	protected $table = 'ip';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'ip',
		'status'
	];

	public function histories()
	{
		return $this->hasMany(History::class, 'ips_id');
	}

	public function loggers()
	{
		return $this->hasMany(Logger::class, 'ips_id');
	}
}
