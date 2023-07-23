<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RightsPermission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|RightsModelHasPermission[] $rightsModelHasPermissions
 * @property Collection|RightsRoleHasPermission[] $rightsRoleHasPermissions
 *
 * @package App\Models
 */
class RightsPermission extends BaseModel
{
	protected $table = 'rights_permissions';
	protected $perPage = 30;
	public static $snakeAttributes = false;

	protected $fillable = [
		'name',
		'guard_name'
	];

	public function rightsModelHasPermissions()
	{
		return $this->hasMany(RightsModelHasPermission::class, 'permission_id');
	}

	public function rightsRoleHasPermissions()
	{
		return $this->hasMany(RightsRoleHasPermission::class, 'permission_id');
	}
}
