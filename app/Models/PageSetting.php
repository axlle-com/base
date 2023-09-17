<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class PageSetting
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string|null $script
 * @property string|null $css
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class PageSetting extends BaseModel
{
	protected $table = 'page_setting';

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
