<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Redirect
 *
 * @property int $id
 * @property string $url
 * @property string $url_old
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Redirect extends BaseModel
{
    protected $table = 'redirect';

    protected $fillable = [
        'url',
        'url_old'
    ];
}
