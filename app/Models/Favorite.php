<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Favorite
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Favorite extends BaseModel
{
	protected $table = 'favorites';
	protected $casts = [
		'resource_id' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'description'
	];
}
