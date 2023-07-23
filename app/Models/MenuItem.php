<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int $menu_item_id
 * @property string|null $resource
 * @property int|null $resource_id
 * @property string $title
 * @property int|null $sort
 * @property string $url
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Menu $menu
 * @property MenuItem $menuItem
 * @property Collection|MenuItem[] $menuItems
 * @property Collection|MenuItemLanguage[] $menuItemLanguages
 *
 * @package App\Models
 */
class MenuItem extends BaseModel
{
	protected $table = 'menu_item';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'menu_id' => 'int',
		'menu_item_id' => 'int',
		'resource_id' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'menu_id',
		'menu_item_id',
		'resource',
		'resource_id',
		'title',
		'sort',
		'url'
	];

	public function menu()
	{
		return $this->belongsTo(Menu::class);
	}

	public function menuItem()
	{
		return $this->belongsTo(MenuItem::class);
	}

	public function menuItems()
	{
		return $this->hasMany(MenuItem::class);
	}

	public function menuItemLanguages()
	{
		return $this->hasMany(MenuItemLanguage::class);
	}
}
