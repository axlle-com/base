<?php

namespace App\Models;

/**
 * Class TagLanguage
 *
 * @property int $id
 * @property int $tag_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 *
 * @property Tag $tag
 *
 * @package App\Models
 */
class TagLanguage extends BaseModel
{
	protected $table = 'tag_language';
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'tag_id' => 'int'
	];

	protected $fillable = [
		'meta_title',
		'meta_description',
		'language',
		'title',
		'title_short',
		'description'
	];

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
