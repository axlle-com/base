<?php

namespace App\Services\Blog\Page;

use App\Models\Page\Page;
use App\Repositories\Interfaces\IPageRepository;
use App\Repositories\Interfaces\IPostCategoryRepository;
use App\Repositories\Interfaces\IPostRepository;
use App\Services\Blog\EntitySaveServices;
use App\Services\Gallery\GalleryServices;
use App\Services\Image\ImageServices;

class PageServices
{
    use EntitySaveServices;

    protected IPageRepository $repo;
    protected ImageServices $imageServices;
    protected Page $model;
    protected GalleryServices $galleryServices;
    protected IPostCategoryRepository $postCategoryRepo;
    protected IPostRepository $postRepo;

    /**
     * @param IPageRepository $repo
     * @param ImageServices $imageServices
     * @param Page $model
     * @param GalleryServices $galleryServices
     * @param IPostCategoryRepository $postCategoryRepo
     * @param IPostRepository $postRepo
     */
    public function __construct(
        IPageRepository $repo,
        ImageServices $imageServices,
        Page $model,
        GalleryServices $galleryServices,
        IPostCategoryRepository $postCategoryRepo,
        IPostRepository $postRepo
    ) {
        $this->repo = $repo;
        $this->imageServices = $imageServices;
        $this->model = $model;
        $this->galleryServices = $galleryServices;
        $this->postCategoryRepo = $postCategoryRepo;
        $this->postRepo = $postRepo;
    }


    public function existUrl(string $temp, ?int $id): bool
    {
        return
            (bool)$this->repo->existUrl($temp, $id)
            || (bool)$this->postRepo->existUrl($temp)
            || (bool)$this->postCategoryRepo->existUrl($temp);
    }
}
