<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class FailedJob
 *
 * @property int $id
 * @property string $uuid
 * @property string $connection
 * @property string $queue
 * @property string $payload
 * @property string $exception
 * @property Carbon $failed_at
 *
 * @package App\Models
 */
class FailedJob extends BaseModel
{
	protected $table = 'failed_jobs';
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'failed_at' => 'datetime'
	];

	protected $fillable = [
		'uuid',
		'connection',
		'queue',
		'payload',
		'exception',
		'failed_at'
	];
}
