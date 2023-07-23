<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Page
 *
 * @property int $id
 * @property int|null $render_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $alias
 * @property string $url
 * @property int|null $is_published
 * @property int|null $is_favourites
 * @property int|null $is_comments
 * @property int|null $is_watermark
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $image
 * @property string|null $media
 * @property int|null $hits
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Render|null $render
 * @property Collection|PageLanguage[] $pageLanguages
 *
 * @package App\Models
 */
class Page extends BaseModel
{
	protected $table = 'page';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'render_id' => 'int',
		'is_published' => 'int',
		'is_favourites' => 'int',
		'is_comments' => 'int',
		'is_watermark' => 'int',
		'hits' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'render_id',
		'meta_title',
		'meta_description',
		'alias',
		'url',
		'is_published',
		'is_favourites',
		'is_comments',
		'is_watermark',
		'title',
		'title_short',
		'description',
		'image',
		'media',
		'hits',
		'sort'
	];

	public function render()
	{
		return $this->belongsTo(Render::class);
	}

	public function pageLanguages()
	{
		return $this->hasMany(PageLanguage::class);
	}
}
