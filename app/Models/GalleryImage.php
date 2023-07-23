<?php

namespace App\Models;

/**
 * Class GalleryImage
 *
 * @property int $id
 * @property int|null $gallery_id
 * @property string $image
 * @property string|null $title
 * @property string|null $description
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Gallery|null $gallery
 *
 * @package App\Models
 */
class GalleryImage extends BaseModel
{
	protected $table = 'gallery_image';
	protected $perPage = 30;
	public static $snakeAttributes = false;

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
