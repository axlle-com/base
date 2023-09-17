<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Url
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string $alias
 * @property string $url
 * @property string|null $url_old
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Url extends BaseModel
{
	protected $table = 'url';

	protected $casts = [
		'resource_id' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'alias',
		'url',
		'url_old'
	];
}
