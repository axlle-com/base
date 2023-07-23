<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Tag
 *
 * @property int $id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int|null $is_sitemap
 * @property int|null $is_published
 * @property int|null $is_favourites
 * @property int|null $is_watermark
 * @property string|null $image
 * @property int|null $show_image
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property TagHasResource $tagHasResource
 * @property Collection|TagLanguage[] $tagLanguages
 *
 * @package App\Models
 */
class Tag extends BaseModel
{
	protected $table = 'tag';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $casts = [
		'is_sitemap' => 'int',
		'is_published' => 'int',
		'is_favourites' => 'int',
		'is_watermark' => 'int',
		'show_image' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'meta_title',
		'meta_description',
		'is_sitemap',
		'is_published',
		'is_favourites',
		'is_watermark',
		'image',
		'show_image',
		'title',
		'title_short',
		'description',
		'sort'
	];

	public function tagHasResource()
	{
		return $this->hasOne(TagHasResource::class);
	}

	public function tagLanguages()
	{
		return $this->hasMany(TagLanguage::class);
	}
}
