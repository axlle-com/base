<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use App\Models\InfoBlock\InfoBlock;
use App\Models\Traits\HasGallery;
use App\Models\Traits\HasHistory;
use App\Models\Traits\HasImage;
use App\Models\Traits\HasInfoBlock;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post
 *
 * @property int $id
 * @property string|null $render
 * @property int|null $post_category_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $alias
 * @property string $url
 * @property bool|null $is_published
 * @property bool|null $is_favourites
 * @property bool|null $is_comments
 * @property bool|null $is_image_post
 * @property bool|null $is_image_category
 * @property bool|null $is_watermark
 * @property bool|null $is_sitemap
 * @property string|null $media
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 * @property bool|null $show_date
 * @property Carbon|null $date_pub
 * @property Carbon|null $date_end
 * @property bool|null $control_date_pub
 * @property bool|null $control_date_end
 * @property string|null $image
 * @property int|null $hits
 * @property int|null $sort
 * @property float|null $stars
 * @property string|null $script
 * @property string|null $css
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property PostCategory|null $postCategory
 * @property Collection|InfoBlock[] $infoBlocks
 * @property Collection|PostLanguage[] $postLanguages
 *
 * @package App\Models
 */
class Post extends BaseModel
{
    use HasGallery;
    use HasImage;
    use HasHistory;
    use HasInfoBlock;

    protected $table = 'post';

    protected $casts = [
        'post_category_id' => 'int',
        'is_published' => 'bool',
        'is_favourites' => 'bool',
        'is_comments' => 'bool',
        'is_image_post' => 'bool',
        'is_image_category' => 'bool',
        'is_watermark' => 'bool',
        'is_sitemap' => 'bool',
        'show_date' => 'bool',
        'date_pub' => 'datetime',
        'date_end' => 'datetime',
        'control_date_pub' => 'bool',
        'control_date_end' => 'bool',
        'hits' => 'int',
        'sort' => 'int',
        'stars' => 'float'
    ];

    protected $fillable = [
        'render',
        'post_category_id',
        'meta_title',
        'meta_description',
        'alias',
        'url',
        'is_published',
        'is_favourites',
        'is_comments',
        'is_image_post',
        'is_image_category',
        'is_watermark',
        'is_sitemap',
        'media',
        'title',
        'title_short',
        'preview_description',
        'description',
        'show_date',
        'date_pub',
        'date_end',
        'control_date_pub',
        'control_date_end',
        'image',
        'hits',
        'sort',
        'stars',
        'script',
        'css',
    ];

    /**
     * @return BelongsTo
     */
    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }

    /**
     * @return HasMany
     */
    public function postLanguages(): HasMany
    {
        return $this->hasMany(PostLanguage::class);
    }
}
