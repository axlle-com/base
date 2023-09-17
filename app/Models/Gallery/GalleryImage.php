<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * Class GalleryImage
 *
 * @property int $id
 * @property int|null $gallery_id
 * @property string $image
 * @property string|null $title
 * @property string|null $description
 * @property int|null $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Gallery|null $gallery
 *
 * @package App\Models
 */
class GalleryImage extends BaseModel
{
	protected $table = 'gallery_image';

	protected $casts = [
		'gallery_id' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'gallery_id',
		'image',
		'title',
		'description',
		'sort'
	];

	public function gallery()
	{
		return $this->belongsTo(Gallery::class);
	}
}
