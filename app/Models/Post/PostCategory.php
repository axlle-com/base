<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\InfoBlock;
use App\Models\Render;
use Carbon\Carbon;
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
 * @property bool|null $is_published
 * @property bool|null $is_favourites
 * @property bool|null $is_watermark
 * @property bool|null $is_sitemap
 * @property string|null $image
 * @property bool|null $show_image
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $preview_description
 * @property int|null $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property PostCategory|null $postCategory
 * @property Render|null $render
 * @property Collection|Post[] $posts
 * @property Collection|PostCategory[] $postCategories
 * @property Collection|InfoBlock[] $infoBlocks
 * @property Collection|PostCategoryLanguage[] $postCategoryLanguages
 *
 * @package App\Models
 */
class PostCategory extends BaseModel
{
	protected $table = 'post_category';


	protected $casts = [
		'render_id' => 'int',
		'post_category_id' => 'int',
		'is_published' => 'bool',
		'is_favourites' => 'bool',
		'is_watermark' => 'bool',
		'is_sitemap' => 'bool',
		'show_image' => 'bool',
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
		'is_sitemap',
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

	public function infoBlocks()
	{
		return $this->belongsToMany(InfoBlock::class, 'post_category_has_info_block')
					->withPivot('sort');
	}

	public function postCategoryLanguages()
	{
		return $this->hasMany(PostCategoryLanguage::class);
	}
}
