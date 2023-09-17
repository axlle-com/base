<?php

namespace App\Models;

use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InfoBlock
 *
 * @property int $id
 * @property string $position
 * @property int|null $sort
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 * @property bool|null $is_watermark
 * @property string|null $media
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|InfoBlockLanguage[] $infoBlockLanguages
 * @property Collection|Page[] $pages
 * @property Collection|PostCategory[] $postCategories
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class InfoBlock extends BaseModel
{
	protected $table = 'info_block';

	protected $casts = [
		'sort' => 'int',
		'is_watermark' => 'bool'
	];

	protected $fillable = [
		'position',
		'sort',
		'title',
		'title_short',
		'preview_description',
		'description',
		'is_watermark',
		'media',
		'image'
	];

	public function infoBlockLanguages()
	{
		return $this->hasMany(InfoBlockLanguage::class);
	}

	public function pages()
	{
		return $this->belongsToMany(Page::class, 'page_has_info_block')
					->withPivot('sort');
	}

	public function postCategories()
	{
		return $this->belongsToMany(PostCategory::class, 'post_category_has_info_block')
					->withPivot('sort');
	}

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'post_has_info_block')
					->withPivot('sort');
	}
}
