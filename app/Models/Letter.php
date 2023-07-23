<?php

namespace App\Models;

/**
 * Class Letter
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string $person
 * @property int $person_id
 * @property string|null $subject
 * @property string|null $text
 * @property int|null $is_viewed
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Letter extends BaseModel
{
	protected $table = 'letter';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'resource_id' => 'int',
		'person_id' => 'int',
		'is_viewed' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'person',
		'person_id',
		'subject',
		'text',
		'is_viewed'
	];
}
