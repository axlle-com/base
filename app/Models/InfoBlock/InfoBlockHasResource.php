<?php
namespace App\Models\InfoBlock;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class InfoBlockHasResource
 *
 * @property int $id
 * @property string $resource
 * @property int $resource_id
 * @property int $info_block_id
 * @property string $position
 * @property int|null $sort
 *
 * @property InfoBlock $infoBlock
 *
 * @package App\Models
 */
class InfoBlockHasResource extends BaseModel
{
	protected $table = 'info_block_has_resource';
	public $timestamps = false;

	protected $casts = [
		'resource_id' => 'int',
		'info_block_id' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'resource',
		'resource_id',
		'info_block_id',
		'position',
		'sort'
	];

    /**
     * @return BelongsTo
     */
	public function infoBlock(): BelongsTo
    {
		return $this->belongsTo(InfoBlock::class);
	}
}
