<?php

namespace App\Models\Gallery;

use App\Models\BaseModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

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

    public function createPath(array $post): string
    {
        $dir = public_path('upload/' . $post['images_path']);
        if (!file_exists($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        return 'upload/' . $post['images_path'];
    }

    public static function createOrUpdate(array $attributes): static
    {
        $inst = [];
        $collection = new self();
        foreach ($attributes['images'] as $image) {
            /** @var $model self */
            if (
                ($id = $image['id'] ?? null)
                && $model = self::query()
                    ->where('id', $id)
                    ->first()
            ) {
                if ($image['title'] ?? null) {
                    $model->title = $image['title'];
                }
                if ($image['description'] ?? null) {
                    $model->description = $image['description'];
                }
                if ($image['sort'] ?? null) {
                    $model->sort = $image['sort'];
                }
                if ($model->save()) {
                    $inst[] = $model;
                }
            } else {
                if (!empty($image['file']) && file_exists($image['file'])) {
                    try {
                        $types = self::getType(exif_imagetype($image['file']));
                    } catch (Exception $e) {
                    }
                    if (!empty($types)) {
                        $dir = '/upload/' . $attributes['images_path'];
                        $path = public_path($dir);
                        if (!File::isDirectory($path)) {
                            File::makeDirectory($path, 0777, true, true);
                        }
                        $url = Str::random(40) . '.' . $types;
                        $filename = $path . '/' . $url;

                        if (empty($attributes['images_copy'])) {
                            $suc = move_uploaded_file($image['file'], $filename);
                        } else {
                            $suc = copy($image['file'], $filename);
                        }
                        if ($suc) {
                            $model = new static();
                            $model->title = $image['title'] ?? null;
                            $model->gallery_id = $attributes['gallery_id'];
                            $model->description = $image['description'] ?? null;
                            $model->sort = $image['sort'] ?? null;
                            $model->image = $dir . '/' . $url;
                            if ($model->save()) {
                                $inst[] = $model;
                            }
                        }
                    }
                }
            }
        }

        return $collection->setCollection($inst);
    }
}
