<?php

namespace App\Models;

/**
 * Class PostCategoryLanguage
 *
 * @property int $id
 * @property int $post_category_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $preview_description
 *
 * @property PostCategory $postCategory
 *
 * @package App\Models
 */
class PostCategoryLanguage extends BaseModel
{
	protected $table = 'post_category_language';
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'post_category_id' => 'int'
	];

	protected $fillable = [
		'meta_title',
		'meta_description',
		'language',
		'title',
		'title_short',
		'description',
		'preview_description'
	];

	public function postCategory()
	{
		return $this->belongsTo(PostCategory::class);
	}
}
