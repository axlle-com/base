<?php

namespace App\Models;

/**
 * Class PhoneHasResource
 *
 * @property int $phone_id
 * @property string $resource
 * @property int $resource_id
 *
 * @property Phone $phone
 *
 * @package App\Models
 */
class PhoneHasResource extends BaseModel
{
	protected $table = 'phone_has_resource';
	protected $primaryKey = 'phone_id';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'phone_id' => 'int',
		'resource_id' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
