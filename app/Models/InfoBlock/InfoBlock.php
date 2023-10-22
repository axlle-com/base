<?php

namespace App\Models\InfoBlock;

use App\Models\BaseModel;
use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Traits\HasGallery;
use App\Models\Traits\HasHistory;
use App\Models\Traits\HasImage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class InfoBlock
 *
 * @property int $id
 * @property string|null $render
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
    use HasGallery;
    use HasImage;
    use HasHistory;

    protected $table = 'info_block';

    protected $casts = [
        'is_watermark' => 'bool'
    ];

    protected $fillable = [
        'render',
        'title',
        'title_short',
        'preview_description',
        'description',
        'is_watermark',
        'media',
        'image'
    ];

    /**
     * @return HasMany
     */
    public function infoBlockLanguages(): HasMany
    {
        return $this->hasMany(InfoBlockLanguage::class);
    }
}
