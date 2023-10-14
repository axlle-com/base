<?php

namespace App\Services\Blog\PostCategory;

use App\Models\Post\PostCategory;
use App\Repositories\Interfaces\IPageRepository;
use App\Repositories\Interfaces\IPostCategoryRepository;
use App\Repositories\Interfaces\IPostRepository;
use App\Services\Blog\EntitySaveServices;
use App\Services\Gallery\GalleryServices;
use App\Services\Image\ImageServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostCategoryServices
{
    use EntitySaveServices;

    protected IPostCategoryRepository $repo;
    protected PostCategory $model;
    protected ImageServices $imageServices;
    protected GalleryServices $galleryServices;
    protected IPostRepository $postRepo;
    protected IPageRepository $pageRepo;

    /**
     * @param IPostCategoryRepository $repo
     * @param PostCategory $model
     * @param ImageServices $imageServices
     * @param GalleryServices $galleryServices
     * @param IPostRepository $postRepo
     * @param IPageRepository $pageRepo
     */
    public function __construct(
        IPostCategoryRepository $repo,
        PostCategory $model,
        ImageServices $imageServices,
        GalleryServices $galleryServices,
        IPostRepository $postRepo,
        IPageRepository $pageRepo
    ) {
        $this->repo = $repo;
        $this->model = $model;
        $this->imageServices = $imageServices;
        $this->galleryServices = $galleryServices;
        $this->postRepo = $postRepo;
        $this->pageRepo = $pageRepo;
    }

    public function existUrl(string $temp, ?int $id): bool
    {
        return
            (bool)$this->postRepo->existAlias($temp)
            || (bool)$this->pageRepo->existAlias($temp)
            || (bool)$this->repo->existAlias($temp, $id);
    }
}
