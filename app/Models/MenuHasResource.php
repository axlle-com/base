<?php

namespace App\Models;

/**
 * Class MenuHasResource
 *
 * @property int $menu_id
 * @property string $resource
 * @property int $resource_id
 *
 * @property Menu $menu
 *
 * @package App\Models
 */
class MenuHasResource extends BaseModel
{
	protected $table = 'menu_has_resource';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'menu_id' => 'int',
		'resource_id' => 'int'
	];

	protected $fillable = [
		'menu_id',
		'resource',
		'resource_id'
	];

	public function menu()
	{
		return $this->belongsTo(Menu::class);
	}
}
