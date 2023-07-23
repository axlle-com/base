<?php

namespace App\Models;

/**
 * Class PostLanguage
 *
 * @property int $id
 * @property int $post_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 *
 * @property Post $post
 *
 * @package App\Models
 */
class PostLanguage extends BaseModel
{
	protected $table = 'post_language';
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'post_id' => 'int'
	];

	protected $fillable = [
		'meta_title',
		'meta_description',
		'language',
		'title',
		'title_short',
		'preview_description',
		'description'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
