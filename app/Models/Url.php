<?php

namespace App\Models;

/**
 * Class Url
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string $alias
 * @property string $url
 * @property string|null $url_old
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Url extends BaseModel
{
	protected $table = 'url';
	protected $perPage = 30;
	public static $snakeAttributes = false;

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
