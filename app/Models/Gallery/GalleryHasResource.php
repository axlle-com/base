<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;

/**
 * Class GalleryHasResource
 *
 * @property int $gallery_id
 * @property string $resource
 * @property int $resource_id
 *
 * @property Gallery $gallery
 *
 * @package App\Models
 */
class GalleryHasResource extends BaseModel
{
	protected $table = 'gallery_has_resource';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'gallery_id' => 'int',
		'resource_id' => 'int'
	];

	public function gallery()
	{
		return $this->belongsTo(Gallery::class);
	}
}
