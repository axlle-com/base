<?php

namespace App\Models;

/**
 * Class Setting
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string|null $description
 * @property string|null $value_string
 * @property string|null $value_text
 * @property array|null $value_json
 * @property int|null $value_bool
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Setting extends BaseModel
{
	protected $table = 'setting';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'value_json' => 'json',
		'value_bool' => 'int'
	];

	protected $fillable = [
		'key',
		'title',
		'description',
		'value_string',
		'value_text',
		'value_json',
		'value_bool'
	];
}
