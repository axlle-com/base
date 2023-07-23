<?php

namespace App\Models;

/**
 * Class MenuItemLanguage
 *
 * @property int $id
 * @property string $title
 * @property string $language
 * @property int $menu_item_id
 *
 * @property MenuItem $menuItem
 *
 * @package App\Models
 */
class MenuItemLanguage extends BaseModel
{
	protected $table = 'menu_item_language';
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'menu_item_id' => 'int'
	];

	protected $fillable = [
		'title',
		'language'
	];

	public function menuItem()
	{
		return $this->belongsTo(MenuItem::class);
	}
}
