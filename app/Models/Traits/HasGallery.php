<?php

namespace App\Models\Traits;

use App\Models\BaseModel;
use App\Models\Gallery\Gallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * @property Collection|Gallery[] $manyGallery
 * @property Collection|Gallery[] $manyGalleryWithImages
 */
trait HasGallery
{
    public function manyGallery(): BelongsToMany
    {
        /** @var $this BaseModel */
        return $this->belongsToMany(
            Gallery::class,
            'gallery_has_resource',
            'resource_id',
            'gallery_id'
        )->wherePivot('resource', '=', $this->getTable());
    }

    public function manyGalleryWithImages(): BelongsToMany
    {
        /** @var $this BaseModel */
        return $this->belongsToMany(
            Gallery::class,
            'gallery_has_resource',
            'resource_id',
            'gallery_id'
        )->wherePivot('resource', '=', $this->getTable())
            ->with([
                'images' => function ($query) {
                    $query->orderBy('sort');
                }
            ]);
    }

    public function detachManyGallery(): static
    {
        /** @var $this BaseModel */
        DB::table('gallery_has_resource')
            ->where('resource', $this->getTable())
            ->where('resource_id', $this->id)
            ->delete();

        return $this;
    }
}
