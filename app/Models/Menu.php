<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Menu
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property MenuHasResource $menuHasResource
 * @property Collection|MenuItem[] $menuItems
 *
 * @package App\Models
 */
class Menu extends BaseModel
{
	protected $table = 'menu';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'title',
		'name',
		'description'
	];

	public function menuHasResource()
	{
		return $this->hasOne(MenuHasResource::class);
	}

	public function menuItems()
	{
		return $this->hasMany(MenuItem::class);
	}
}
