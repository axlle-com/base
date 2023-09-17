<?php

namespace App\Models;

use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Render
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string|null $resource
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Page[] $pages
 * @property Collection|Post[] $posts
 * @property Collection|PostCategory[] $post_categories
 *
 * @package App\Models
 */
class Render extends BaseModel
{
	protected $table = 'render';

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

	public function post_categories()
	{
		return $this->hasMany(PostCategory::class);
	}
}
