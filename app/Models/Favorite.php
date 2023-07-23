<?php

namespace App\Models;

/**
 * Class Favorite
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Favorite extends BaseModel
{
	protected $table = 'favorites';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'resource_id' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'description'
	];
}
