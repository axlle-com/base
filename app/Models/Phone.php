<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Phone
 *
 * @property int $id
 * @property string $number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|PhoneHasResource[] $phone_has_resources
 *
 * @package App\Models
 */
class Phone extends BaseModel
{
	protected $table = 'phone';

	protected $fillable = [
		'number'
	];

	public function phone_has_resources()
	{
		return $this->hasMany(PhoneHasResource::class);
	}
}
