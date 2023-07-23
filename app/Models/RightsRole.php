<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RightsRole
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|RightsModelHasRole[] $rightsModelHasRoles
 * @property Collection|RightsRoleHasPermission[] $rightsRoleHasPermissions
 *
 * @package App\Models
 */
class RightsRole extends BaseModel
{
	protected $table = 'rights_roles';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'name',
		'guard_name'
	];

	public function rightsModelHasRoles()
	{
		return $this->hasMany(RightsModelHasRole::class, 'role_id');
	}

	public function rightsRoleHasPermissions()
	{
		return $this->hasMany(RightsRoleHasPermission::class, 'role_id');
	}
}
