<?php

namespace App\Models\Traits;

use App\Models\BaseModel;
use App\Models\InfoBlock\InfoBlock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * @property Collection|InfoBlock[] $infoBlocks
 */
trait HasInfoBlock
{
    /**
     * @return BelongsToMany
     */
    public function infoBlocks(): BelongsToMany
    {
        return $this->belongsToMany(
            InfoBlock::class,
            'info_block_has_resource',
            'resource_id',
            'info_block_id',
        )
            ->wherePivot('resource', '=', $this->getTable())
            ->orderBy('info_block_has_resource.sort', 'asc')
            ->withPivot(['id', 'position', 'sort']);
    }

    /**
     * @return BaseModel
     */
    public function detachInfoBlocks(): static
    {
        /** @var $this BaseModel */
        DB::table('info_block_has_resource')
            ->where('resource', $this->getTable())
            ->where('resource_id', $this->id)
            ->delete();

        return $this;
    }
}
