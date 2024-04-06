<?php

namespace App\Services\GalleryImage;

use App\Models\Gallery\GalleryImage;
use App\Repositories\Interfaces\IGalleryImageRepository;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryImageServices
{
    private IGalleryImageRepository $galleryImageRepo;

    /**
     * @param IGalleryImageRepository $galleryImageRepo
     */
    public function __construct(IGalleryImageRepository $galleryImageRepo)
    {
        $this->galleryImageRepo = $galleryImageRepo;
    }

    /**
     * @param array $attributes
     * @return void
     */
    public function uploadFromArray(array $attributes): void
    {
        foreach ($attributes['images'] as $image) {
            $data = $this->prepareAttributes($image);
            /** @var $model self */
            if (
                ($id = $image['id'] ?? null)
                && $this->galleryImageRepo->existById($id)
            ) {
                $this->galleryImageRepo->update($id, $data);
            } elseif (!empty($image['file']) && file_exists($image['file'])) {
                try {
                    $types = $image['file']->extension();
                } catch (Exception $e) {
                }
                if (!empty($types)) {
                    $dir = '/upload/' . trim($attributes['images_path'], '/');
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
                        $data['gallery_id'] = $attributes['gallery_id'];
                        $data['image'] = $dir . '/' . $url;
                        $this->galleryImageRepo->create($data);
                    }
                }
            }
        }
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function prepareAttributes(array $attributes): array
    {
        $newAttributes = [];
        if ($attributes['title'] ?? null) {
            $newAttributes['title'] = $attributes['title'];
        }
        if ($image['description'] ?? null) {
            $newAttributes['description'] = $attributes['description'];
        }
        if ($attributes['sort'] ?? null) {
            $newAttributes['sort'] = $attributes['sort'];
        }

        return $newAttributes;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        /** @var GalleryImage $model */
        if (
            ($model = $this->galleryImageRepo->find($id))
            && $model->image
        ) {
            if (file_exists(public_path($model->image))) {
                unlink(public_path($model->image));
            }

            return $this->galleryImageRepo->delete($id);
        }

        return false;
    }
}
