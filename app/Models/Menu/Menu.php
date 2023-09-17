<?php

namespace App\Models\Menu;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Menu
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|MenuHasResource[] $menuHasResources
 * @property Collection|MenuItem[] $menuItems
 *
 * @package App\Models
 */
class Menu extends BaseModel
{
	protected $table = 'menu';

	protected $fillable = [
		'title',
		'name',
		'description'
	];

	public function menuHasResources()
	{
		return $this->hasMany(MenuHasResource::class);
	}

	public function menuItems()
	{
		return $this->hasMany(MenuItem::class);
	}
}
