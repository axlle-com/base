<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Letter
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property string $person
 * @property int $person_id
 * @property string|null $subject
 * @property string|null $text
 * @property bool|null $is_viewed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Letter extends BaseModel
{
    protected $table = 'letter';

    protected $casts = [
        'resource_id' => 'int',
        'person_id' => 'int',
        'is_viewed' => 'bool'
    ];

    protected $fillable = [
        'resource',
        'resource_id',
        'person',
        'person_id',
        'subject',
        'text',
        'is_viewed'
    ];
}
