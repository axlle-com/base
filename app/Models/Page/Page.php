<?php

namespace App\Models\Page;

use App\Models\BaseModel;
use App\Models\InfoBlock\InfoBlock;
use App\Models\Traits\HasGallery;
use App\Models\Traits\HasHistory;
use App\Models\Traits\HasImage;
use App\Models\Traits\HasInfoBlock;
use App\Models\Traits\HasUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Page
 *
 * @property int $id
 * @property string|null $render
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $alias
 * @property string $url
 * @property bool|null $is_published
 * @property bool|null $is_favourites
 * @property bool|null $is_comments
 * @property bool|null $is_watermark
 * @property bool|null $is_sitemap
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property string|null $image
 * @property string|null $media
 * @property int|null $hits
 * @property int|null $sort
 * @property string|null $script
 * @property string|null $css
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|InfoBlock[] $infoBlocks
 * @property Collection|PageLanguage[] $pageLanguages
 *
 * @package App\Models
 */
class Page extends BaseModel
{
    use HasUrl;
    use HasGallery;
    use HasImage;
    use HasHistory;
    use HasInfoBlock;

    protected $table = 'page';

    protected $casts = [
        'is_published' => 'bool',
        'is_favourites' => 'bool',
        'is_comments' => 'bool',
        'is_watermark' => 'bool',
        'is_sitemap' => 'bool',
        'hits' => 'int',
        'sort' => 'int'
    ];

    protected $fillable = [
        'render',
        'meta_title',
        'meta_description',
        'alias',
        'url',
        'is_published',
        'is_favourites',
        'is_comments',
        'is_watermark',
        'is_sitemap',
        'title',
        'title_short',
        'description',
        'image',
        'media',
        'hits',
        'sort',
        'script',
        'css',
    ];

    /**
     * @return HasMany
     */
    public function pageLanguages(): HasMany
    {
        return $this->hasMany(PageLanguage::class);
    }
}
