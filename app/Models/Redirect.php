<?php

namespace App\Models;

/**
 * Class Redirect
 *
 * @property int $id
 * @property string $url
 * @property string $url_old
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Redirect extends BaseModel
{
	protected $table = 'redirect';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'url',
		'url_old'
	];
}
