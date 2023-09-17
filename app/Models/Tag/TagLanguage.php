<?php

namespace App\Models\Tag;

use App\Models\BaseModel;

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

	public $timestamps = false;

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
