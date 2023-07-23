<?php

namespace App\Models;

/**
 * Class Phone
 *
 * @property int $id
 * @property string $number
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property PhoneHasResource $phoneHasResource
 *
 * @package App\Models
 */
class Phone extends BaseModel
{
	protected $table = 'phone';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'number'
	];

	public function phoneHasResource()
	{
		return $this->hasOne(PhoneHasResource::class);
	}
}
