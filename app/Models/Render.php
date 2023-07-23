<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Render
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string|null $resource
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Page[] $pages
 * @property Collection|Post[] $posts
 * @property Collection|PostCategory[] $postCategories
 *
 * @package App\Models
 */
class Render extends BaseModel
{
	protected $table = 'render';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'title',
		'name',
		'resource'
	];

	public function pages()
	{
		return $this->hasMany(Page::class);
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function postCategories()
	{
		return $this->hasMany(PostCategory::class);
	}
}
