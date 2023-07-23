<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Post
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
 * @property int|null $is_comments
 * @property int|null $is_image_post
 * @property int|null $is_image_category
 * @property int|null $is_watermark
 * @property string|null $media
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 * @property int|null $show_date
 * @property int|null $date_pub
 * @property int|null $date_end
 * @property int|null $control_date_pub
 * @property int|null $control_date_end
 * @property string|null $image
 * @property int|null $hits
 * @property int|null $sort
 * @property float|null $stars
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property PostCategory|null $postCategory
 * @property Render|null $render
 * @property Collection|PostLanguage[] $postLanguages
 *
 * @package App\Models
 */
class Post extends BaseModel
{
	protected $table = 'post';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'render_id' => 'int',
		'post_category_id' => 'int',
		'is_published' => 'int',
		'is_favourites' => 'int',
		'is_comments' => 'int',
		'is_image_post' => 'int',
		'is_image_category' => 'int',
		'is_watermark' => 'int',
		'show_date' => 'int',
		'date_pub' => 'int',
		'date_end' => 'int',
		'control_date_pub' => 'int',
		'control_date_end' => 'int',
		'hits' => 'int',
		'sort' => 'int',
		'stars' => 'float'
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
		'is_comments',
		'is_image_post',
		'is_image_category',
		'is_watermark',
		'media',
		'title',
		'title_short',
		'preview_description',
		'description',
		'show_date',
		'date_pub',
		'date_end',
		'control_date_pub',
		'control_date_end',
		'image',
		'hits',
		'sort',
		'stars'
	];

	public function postCategory()
	{
		return $this->belongsTo(PostCategory::class);
	}

	public function render()
	{
		return $this->belongsTo(Render::class);
	}

	public function postLanguages()
	{
		return $this->hasMany(PostLanguage::class);
	}
}
