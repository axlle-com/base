<?php

namespace App\Services\Blog\InfoBlock;

use App\Models\BaseModel;
use App\Repositories\Interfaces\IInfoBlockHasResourceRepository;

class InfoBlockHasResourceServices
{
    private IInfoBlockHasResourceRepository $blockHasResourceRepo;

    /**
     * @param IInfoBlockHasResourceRepository $blockHasResourceRepo
     */
    public function __construct(IInfoBlockHasResourceRepository $blockHasResourceRepo)
    {
        $this->blockHasResourceRepo = $blockHasResourceRepo;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->blockHasResourceRepo->delete($id);
    }

    /**
     * @param array $array
     * @param BaseModel $model
     * @return void
     */
    public function createOrUpdateFromArray(array $array, BaseModel $model): void
    {
        foreach ($array as $item) {
            $item['resource'] = $model->getTable();
            $item['resource_id'] = $model->id;
            if (empty($item['info_block_has_resource_id'])) {
                $this->blockHasResourceRepo->create($item);
            } else {
                $this->blockHasResourceRepo->update($item['info_block_has_resource_id'], $item);
            }
        }
    }
}
