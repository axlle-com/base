<?php

namespace App\Models;

/**
 * Class TagHasResource
 *
 * @property int $tag_id
 * @property string $resource
 * @property int $resource_id
 *
 * @property Tag $tag
 *
 * @package App\Models
 */
class TagHasResource extends BaseModel
{
	protected $table = 'tag_has_resource';
	protected $primaryKey = 'tag_id';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'tag_id' => 'int',
		'resource_id' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id'
	];

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
