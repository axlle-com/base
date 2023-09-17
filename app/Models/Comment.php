<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Comment
 *
 * @property int $id
 * @property int|null $comment_id
 * @property string $resource
 * @property int $resource_id
 * @property string $person
 * @property int $person_id
 * @property bool|null $status
 * @property bool|null $is_viewed
 * @property int $level
 * @property string|null $path
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Comment|null $comment
 * @property Collection|Comment[] $comments
 *
 * @package App\Models
 */
class Comment extends BaseModel
{
	protected $table = 'comment';

	protected $casts = [
		'comment_id' => 'int',
		'resource_id' => 'int',
		'person_id' => 'int',
		'status' => 'bool',
		'is_viewed' => 'bool',
		'level' => 'int'
	];

	protected $fillable = [
		'comment_id',
		'resource',
		'resource_id',
		'person',
		'person_id',
		'status',
		'is_viewed',
		'level',
		'path',
		'text'
	];

	public function comment()
	{
		return $this->belongsTo(Comment::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
