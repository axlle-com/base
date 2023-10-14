<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\InfoBlock;
use App\Models\Render;
use App\Models\Traits\HasGallery;
use App\Models\Traits\HasImage;
use App\Models\Traits\HasHistory;
use App\Models\Traits\HasUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property string|null $script
 * @property string|null $css
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
    use HasGallery;
    use HasImage;
    use HasHistory;

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
        'sort',
        'script',
        'css',
    ];

    /**
     * @return BelongsTo
     */
    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    /**
     * @return BelongsTo
     */
    public function render(): BelongsTo
    {
        return $this->belongsTo(Render::class);
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return HasMany
     */
    public function postCategories(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    /**
     * @return BelongsToMany
     */
    public function infoBlocks(): BelongsToMany
    {
        return $this->belongsToMany(InfoBlock::class, 'post_category_has_info_block')
            ->withPivot('sort');
    }

    /**
     * @return HasMany
     */
    public function postCategoryLanguages(): HasMany
    {
        return $this->hasMany(PostCategoryLanguage::class);
    }
}
