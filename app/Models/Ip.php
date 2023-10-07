<?php

namespace App\Models;

use App\Models\History\History;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Ip
 *
 * @property int $id
 * @property string $ip
 * @property bool|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|History[] $histories
 * @property Collection|Logger[] $loggers
 *
 * @package App\Models
 */
class Ip extends BaseModel
{
    protected $table = 'ip';

    protected $casts = [
        'status' => 'bool'
    ];

    protected $fillable = [
        'ip',
        'status'
    ];

    /**
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class, 'ip_id');
    }

    /**
     * @return HasMany
     */
    public function loggers(): HasMany
    {
        return $this->hasMany(Logger::class, 'ip_id');
    }
}
