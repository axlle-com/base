<?php

namespace App\Services\Blog\Post;

use App\Models\Post\Post;
use App\Repositories\Interfaces\IPageRepository;
use App\Repositories\Interfaces\IPostCategoryRepository;
use App\Repositories\Interfaces\IPostRepository;
use App\Services\Blog\EntitySaveServices;
use App\Services\Blog\InfoBlock\InfoBlockHasResourceServices;
use App\Services\Gallery\GalleryServices;
use App\Services\Image\ImageServices;

class PostServices
{
    use EntitySaveServices;

    protected IPostRepository $repo;
    protected ImageServices $imageServices;
    protected Post $model;
    protected GalleryServices $galleryServices;
    protected IPostCategoryRepository $postCategoryRepo;
    protected IPageRepository $pageRepo;
    protected InfoBlockHasResourceServices $infoBlockHasResourceServices;

    /**
     * @param IPostRepository $repo
     * @param ImageServices $imageServices
     * @param Post $model
     * @param GalleryServices $galleryServices
     * @param IPostCategoryRepository $postCategoryRepo
     * @param IPageRepository $pageRepo
     * @param InfoBlockHasResourceServices $infoBlockHasResourceServices
     */
    public function __construct(
        IPostRepository $repo,
        ImageServices $imageServices,
        Post $model,
        GalleryServices $galleryServices,
        IPostCategoryRepository $postCategoryRepo,
        IPageRepository $pageRepo,
        InfoBlockHasResourceServices $infoBlockHasResourceServices
    ) {
        $this->repo = $repo;
        $this->imageServices = $imageServices;
        $this->model = $model;
        $this->galleryServices = $galleryServices;
        $this->postCategoryRepo = $postCategoryRepo;
        $this->pageRepo = $pageRepo;
        $this->infoBlockHasResourceServices = $infoBlockHasResourceServices;
    }


    public function existUrl(string $temp, ?int $id): bool
    {
        return
            (bool)$this->repo->existUrl($temp, $id)
            || (bool)$this->pageRepo->existUrl($temp)
            || (bool)$this->postCategoryRepo->existUrl($temp);
    }
}
