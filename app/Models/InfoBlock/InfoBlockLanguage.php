<?php

namespace App\Models\InfoBlock;

use App\Models\BaseModel;

/**
 * Class InfoBlockLanguage
 *
 * @property int $id
 * @property int $info_block_id
 * @property string $language
 * @property string $title
 * @property string|null $title_short
 * @property string|null $preview_description
 * @property string|null $description
 *
 * @property InfoBlock $infoBlock
 *
 * @package App\Models
 */
class InfoBlockLanguage extends BaseModel
{
    protected $table = 'info_block_language';
    public $timestamps = false;

    protected $casts = [
        'info_block_id' => 'int'
    ];

    protected $fillable = [
        'language',
        'title',
        'title_short',
        'preview_description',
        'description'
    ];

    public function infoBlock()
    {
        return $this->belongsTo(InfoBlock::class);
    }
}
