<?php

namespace App\Models\Tag;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Tag
 *
 * @property int $id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property bool|null $is_sitemap
 * @property bool|null $is_published
 * @property bool|null $is_favourites
 * @property bool|null $is_watermark
 * @property string|null $image
 * @property bool|null $show_image
 * @property string $title
 * @property string|null $title_short
 * @property string|null $description
 * @property int|null $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|TagHasResource[] $tagHasResources
 * @property Collection|TagLanguage[] $tagLanguages
 *
 * @package App\Models
 */
class Tag extends BaseModel
{
    protected $table = 'tag';

    protected $casts = [
        'is_sitemap' => 'bool',
        'is_published' => 'bool',
        'is_favourites' => 'bool',
        'is_watermark' => 'bool',
        'show_image' => 'bool',
        'sort' => 'int'
    ];

    protected $fillable = [
        'meta_title',
        'meta_description',
        'is_sitemap',
        'is_published',
        'is_favourites',
        'is_watermark',
        'image',
        'show_image',
        'title',
        'title_short',
        'description',
        'sort'
    ];

    public function tagHasResources()
    {
        return $this->hasMany(TagHasResource::class);
    }

    public function tagLanguages()
    {
        return $this->hasMany(TagLanguage::class);
    }
}
