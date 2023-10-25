<?php

namespace App\Services\Blog\InfoBlock;

use App\Models\InfoBlock\InfoBlock;
use App\Models\Page\Page;
use App\Repositories\Eloquent\InfoBlockRepository;
use App\Services\Gallery\GalleryServices;
use App\Services\Image\ImageServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class InfoBlockServices
{
    protected ImageServices $imageServices;
    protected InfoBlock $model;
    protected GalleryServices $galleryServices;
    protected InfoBlockRepository $infoBlockRepo;

    /**
     * @param ImageServices $imageServices
     * @param InfoBlock $model
     * @param GalleryServices $galleryServices
     * @param InfoBlockRepository $infoBlockRepo
     */
    public function __construct(
        ImageServices $imageServices,
        InfoBlock $model,
        GalleryServices $galleryServices,
        InfoBlockRepository $infoBlockRepo
    ) {
        $this->imageServices = $imageServices;
        $this->model = $model;
        $this->galleryServices = $galleryServices;
        $this->infoBlockRepo = $infoBlockRepo;
    }

    /**
     * @param int $id
     * @return InfoBlock|null
     */
    public function find(int $id): ?InfoBlock
    {
        /** @var InfoBlock $model */
        $model = $this->infoBlockRepo->find($id);

        return $model;
    }

    /**
     * @return InfoBlock[]|Collection
     */
    public function get(): Collection
    {
        /** @var InfoBlock[]|Collection $model */
        $model = $this->infoBlockRepo->get();

        return $model;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator|InfoBlock[]
     */
    public function filter(array $request): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator|InfoBlock[] $filter */
        $filter = $this->infoBlockRepo->filter($request);

        return $filter;
    }

    /**
     * @param array $attributes
     * @return InfoBlock|Page
     */
    public function create(array $attributes): InfoBlock
    {
        /** @var InfoBlock $model */
        $attributes = $this->prepareAttributes($attributes);
        $model = $this->infoBlockRepo->create($attributes);
        $ids = $this->galleryServices->uploadFromArray($attributes);
        $this->infoBlockRepo->syncGallery($model, $ids);

        return $model;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return InfoBlock|Page
     */
    public function update(int $id, array $attributes): InfoBlock
    {
        /** @var InfoBlock $model */
        $attributes['id'] = $id;
        $attributes = $this->prepareAttributes($attributes);
        $model = $this->infoBlockRepo->update($id, $attributes);
        $ids = $this->galleryServices->uploadFromArray($attributes);
        $this->infoBlockRepo->syncGallery($model, $ids);

        return $model;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function prepareAttributes(array $attributes): array
    {
        $attributes['id'] = $attributes['id'] ?? null;
        $attributes['images_path'] = '/upload/' . $this->model::table();
        if ($attributes['image'] ?? null) {
            $attributes['image'] = $this->imageServices->load($attributes['image'], $attributes['images_path']);
        }
        $attributes['resource'] = $this->model::table();

        return $attributes;
    }
}
