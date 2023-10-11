<?php

namespace App\Services\Gallery;

use App\Models\Gallery\Gallery;
use App\Repositories\Interfaces\IGalleryRepository;
use App\Services\GalleryImage\GalleryImageServices;

class GalleryServices
{
    private IGalleryRepository $galleryRepo;
    private GalleryImageServices $galleryImageServices;

    /**
     * @param IGalleryRepository $galleryRepo
     * @param GalleryImageServices $galleryImageServices
     */
    public function __construct(
        IGalleryRepository $galleryRepo,
        GalleryImageServices $galleryImageServices
    ) {
        $this->galleryRepo = $galleryRepo;
        $this->galleryImageServices = $galleryImageServices;
    }


    /**
     * @param array $attributes
     * @return array
     */
    public function uploadFromArray(array $attributes): array
    {
        $ids = [];
        foreach ($attributes['galleries'] ?? [] as $gallery) {
            $gallery['title'] = $attributes['title'];
            $gallery['images_path'] = $attributes['images_path'];
            /** @var $model Gallery */
            if (
                empty($gallery['gallery_id'])
                || !$model = $this->galleryRepo->existById($gallery['gallery_id'])
            ) {
                $model = $this->galleryRepo->create($gallery);
            } else {
                $model = $this->galleryRepo->update($model->id, $gallery);
            }

            if ($model) {
                if (!empty($gallery['images'])) {
                    $gallery['gallery_id'] = $model->id;
                    $this->galleryImageServices->uploadFromArray($gallery);
                }
                $ids[$model->id] = ['resource' => $attributes['resource']];
            }
        }

        return $ids;
    }
}
