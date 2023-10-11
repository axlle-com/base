<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;
use App\Models\Traits\HasImage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Gallery
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $sort
 * @property string|null $image
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|GalleryHasResource[] $galleryHasResources
 * @property Collection|GalleryImage[] $images
 *
 * @package App\Models
 */
class Gallery extends BaseModel
{
    use HasImage;

    protected $table = 'gallery';

    protected $casts = [
        'sort' => 'int'
    ];

    protected $fillable = [
        'title',
        'description',
        'sort',
        'image',
        'url'
    ];

    /**
     * @return HasMany
     */
    public function galleryHasResources(): HasMany
    {
        return $this->hasMany(GalleryHasResource::class);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}
