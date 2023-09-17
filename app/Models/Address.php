<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Address
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property int $type
 * @property bool|null $is_delivery
 * @property string|null $address
 * @property int|null $index
 * @property string|null $country
 * @property string|null $region
 * @property string|null $city
 * @property string|null $street
 * @property string|null $house
 * @property string|null $apartment
 * @property string|null $description
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Address extends BaseModel
{
	protected $table = 'address';

	protected $casts = [
		'resource_id' => 'int',
		'type' => 'int',
		'is_delivery' => 'bool',
		'index' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'type',
		'is_delivery',
		'address',
		'index',
		'country',
		'region',
		'city',
		'street',
		'house',
		'apartment',
		'description',
		'image'
	];
}
