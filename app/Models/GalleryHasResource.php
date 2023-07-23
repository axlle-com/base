<?php

namespace App\Models;

/**
 * Class GalleryHasResource
 *
 * @property string $resource
 * @property int $resource_id
 * @property int $gallery_id
 *
 * @property Gallery $gallery
 *
 * @package App\Models
 */
class GalleryHasResource extends BaseModel
{
	protected $table = 'gallery_has_resource';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'resource_id' => 'int',
		'gallery_id' => 'int'
	];

	public function gallery()
	{
		return $this->belongsTo(Gallery::class);
	}
}
