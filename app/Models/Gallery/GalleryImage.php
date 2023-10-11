<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;
use App\Models\Traits\HasImage;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class GalleryImage
 *
 * @property int $id
 * @property int|null $gallery_id
 * @property string $image
 * @property string|null $title
 * @property string|null $description
 * @property int|null $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Gallery|null $gallery
 *
 * @package App\Models
 */
class GalleryImage extends BaseModel
{
    use HasImage;

    protected $table = 'gallery_image';

    protected $casts = [
        'gallery_id' => 'int',
        'sort' => 'int'
    ];

    protected $fillable = [
        'gallery_id',
        'image',
        'title',
        'description',
        'sort'
    ];

    /**
     * @return BelongsTo
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
