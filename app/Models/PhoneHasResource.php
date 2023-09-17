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
	public $incrementing = false;

	public $timestamps = false;

	protected $casts = [
		'phone_id' => 'int',
		'resource_id' => 'int'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
