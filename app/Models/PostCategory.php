<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class PostCategory
 *
 * @property int $id
 * @property int|null $render_id
 * @property int|null $post_category_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $alias
 * @property string $url
 * @property int|null $is_published
 * @property int|null $is_favourites
 * @property int|null $is_watermark
 * @property string|null $image
 * @property int|null $show_image
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $preview_description
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property PostCategory|null $postCategory
 * @property Render|null $render
 * @property Collection|Post[] $posts
 * @property Collection|PostCategory[] $postCategories
 * @property Collection|PostCategoryLanguage[] $postCategoryLanguages
 *
 * @package App\Models
 */
class PostCategory extends BaseModel
{
	protected $table = 'post_category';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'render_id' => 'int',
		'post_category_id' => 'int',
		'is_published' => 'int',
		'is_favourites' => 'int',
		'is_watermark' => 'int',
		'show_image' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'render_id',
		'post_category_id',
		'meta_title',
		'meta_description',
		'alias',
		'url',
		'is_published',
		'is_favourites',
		'is_watermark',
		'image',
		'show_image',
		'title',
		'title_short',
		'description',
		'preview_description',
		'sort'
	];

	public function postCategory()
	{
		return $this->belongsTo(PostCategory::class);
	}

	public function render()
	{
		return $this->belongsTo(Render::class);
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function postCategories()
	{
		return $this->hasMany(PostCategory::class);
	}

	public function postCategoryLanguages()
	{
		return $this->hasMany(PostCategoryLanguage::class);
	}
}
