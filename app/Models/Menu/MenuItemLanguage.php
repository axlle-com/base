<?php

namespace App\Models\Menu;

use App\Models\BaseModel;

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

	public $timestamps = false;

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
