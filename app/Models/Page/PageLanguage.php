<?php

namespace App\Models\Page;

use App\Models\BaseModel;

/**
 * Class PageLanguage
 *
 * @property int $id
 * @property int $page_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 *
 * @property Page $page
 *
 * @package App\Models
 */
class PageLanguage extends BaseModel
{
	protected $table = 'page_language';

	public $timestamps = false;

	protected $casts = [
		'page_id' => 'int'
	];

	protected $fillable = [
		'meta_title',
		'meta_description',
		'language',
		'title',
		'title_short',
		'description'
	];

	public function page()
	{
		return $this->belongsTo(Page::class);
	}
}
