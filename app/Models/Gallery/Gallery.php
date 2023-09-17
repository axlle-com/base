<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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
 * @property Collection|GalleryImage[] $galleryImages
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

	public function galleryHasResources()
	{
		return $this->hasMany(GalleryHasResource::class);
	}

	public function galleryImages()
	{
		return $this->hasMany(GalleryImage::class);
	}
}
