<?php

namespace App\Models;

/**
 * Class PageSetting
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string|null $script
 * @property string|null $css
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class PageSetting extends BaseModel
{
	protected $table = 'page_setting';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'resource_id' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'script',
		'css'
	];
}
