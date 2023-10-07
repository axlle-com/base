<?php

namespace App\Models\Tag;

use App\Models\BaseModel;

/**
 * Class TagHasResource
 *
 * @property int $tag_id
 * @property string $resource
 * @property int $resource_id
 *
 * @property Tag $tag
 *
 * @package App\Models
 */
class TagHasResource extends BaseModel
{
    protected $table = 'tag_has_resource';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'tag_id' => 'int',
        'resource_id' => 'int'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
