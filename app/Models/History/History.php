<?php

namespace App\Models\History;

use App\Models\BaseModel;
use App\Models\Ip;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class History
 *
 * @property int $id
 * @property int|null $ip_id
 * @property int|null $user_id
 * @property string $resource
 * @property int $resource_id
 * @property string $event
 * @property string|null $body
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Ip|null $ip
 * @property User|null $user
 *
 * @package App\Models
 */
class History extends BaseModel
{
	protected $table = 'history';

	protected $casts = [
		'ip_id' => 'int',
		'user_id' => 'int',
		'resource_id' => 'int'
	];

	protected $fillable = [
		'ip_id',
		'user_id',
		'resource',
		'resource_id',
		'event',
		'body',
		'description'
	];

    /**
     * @return BelongsTo
     */
	public function ip(): BelongsTo
    {
		return $this->belongsTo(Ip::class, 'ip_id');
	}

    /**
     * @return BelongsTo
     */
	public function user(): BelongsTo
    {
		return $this->belongsTo(User::class);
	}
}
