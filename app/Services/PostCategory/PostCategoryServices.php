<?php

namespace App\Services\PostCategory;

use App\Models\Post\PostCategory;
use App\Repositories\Interfaces\IPostCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class PostCategoryServices
{
    private IPostCategoryRepository $postCategoryRepo;

    /**
     * @param IPostCategoryRepository $postCategoryRepo
     */
    public function __construct(IPostCategoryRepository $postCategoryRepo)
    {
        $this->postCategoryRepo = $postCategoryRepo;
    }


    /**
     * @param int $id
     * @return PostCategory|null
     */
    public function find(int $id): ?PostCategory
    {
        /** @var PostCategory $model */
        $model = $this->postCategoryRepo->find($id);

        return $model;
    }

    /**
     * @return Collection|PostCategory[]
     */
    public function get(): Collection
    {
        /** @var  Collection|PostCategory[] $get */
        $get = $this->postCategoryRepo->get();

        return $get;
    }
}
