<?php

namespace App\Services\Render;

use App\Models\Render;
use App\Repositories\Interfaces\IRenderRepository;
use Illuminate\Database\Eloquent\Collection;

class RenderServices
{
    private IRenderRepository $renderRepo;

    /**
     * @param IRenderRepository $renderRepo
     */
    public function __construct(IRenderRepository $renderRepo)
    {
        $this->renderRepo = $renderRepo;
    }

    /**
     * @param int $id
     * @return Render|null
     */
    public function find(int $id): ?Render
    {
        /** @var Render $model */
        $model = $this->renderRepo->find($id);

        return $model;
    }

    /**
     * @return Collection|Render[]
     */
    public function get(): Collection
    {
        /** @var  Collection|Render[] $get */
        $get = $this->renderRepo->get();

        return $get;
    }
}
