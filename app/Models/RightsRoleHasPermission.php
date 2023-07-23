<?php

namespace App\Models;

/**
 * Class RightsRoleHasPermission
 *
 * @property int $permission_id
 * @property int $role_id
 *
 * @property RightsPermission $rightsPermission
 * @property RightsRole $rightsRole
 *
 * @package App\Models
 */
class RightsRoleHasPermission extends BaseModel
{
	protected $table = 'rights_role_has_permissions';
	public $incrementing = false;
	protected $perPage = 30;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'permission_id' => 'int',
		'role_id' => 'int'
	];

	public function rightsPermission()
	{
		return $this->belongsTo(RightsPermission::class, 'permission_id');
	}

	public function rightsRole()
	{
		return $this->belongsTo(RightsRole::class, 'role_id');
	}
}
