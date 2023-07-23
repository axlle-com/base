<?php

namespace App\Models;

/**
 * Class RightsModelHasPermission
 *
 * @property int $permission_id
 * @property string $model_type
 * @property int $model_id
 *
 * @property RightsPermission $rightsPermission
 *
 * @package App\Models
 */
class RightsModelHasPermission extends BaseModel
{
	protected $table = 'rights_model_has_permissions';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'permission_id' => 'int',
		'model_id' => 'int'
	];

	public function rightsPermission()
	{
		return $this->belongsTo(RightsPermission::class, 'permission_id');
	}
}
