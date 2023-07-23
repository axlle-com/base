<?php

namespace App\Models;

/**
 * Class RightsModelHasRole
 *
 * @property int $role_id
 * @property string $model_type
 * @property int $model_id
 *
 * @property RightsRole $rightsRole
 *
 * @package App\Models
 */
class RightsModelHasRole extends BaseModel
{
	protected $table = 'rights_model_has_roles';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'role_id' => 'int',
		'model_id' => 'int'
	];

	public function rightsRole()
	{
		return $this->belongsTo(RightsRole::class, 'role_id');
	}
}
