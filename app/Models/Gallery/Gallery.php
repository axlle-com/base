<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;
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
    public function galleryImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function createOrUpdate(array $attributes): static
    {
        /** @var $model self */
        if (
            empty($attributes['gallery_id'])
            || !$model = self::query()->where('id', $attributes['gallery_id'])->first()
        ) {
            $model = new self();
        }
        $model->title = $attributes['title'];
        if (isset($attributes['description'])) {
            $model->description = $attributes['description'];
        }
        if (isset($attributes['url'])) {
            $model->url = $attributes['url'];
        }
        if (isset($attributes['sort'])) {
            $model->sort = $attributes['sort'];
        }
        if ($model->save() && !empty($attributes['images'])) {
            $attributes['gallery_id'] = $model->id;
            $image = GalleryImage::createOrUpdate($attributes);
        }
        return $model;
    }
}
