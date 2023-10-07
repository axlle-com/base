<?php

namespace App\Observers;

use App\Models\Post\PostCategory;

class PostCategoryObserver extends BaseHistoryObserver
{
    /**
     * @param PostCategory $model
     * @return void
     */
    public function creating(PostCategory $model): void
    {
        $model->setAlias()->setUrl();
    }

    /**
     * @param PostCategory $model
     * @return void
     */
    public function updating(PostCategory $model): void
    {
        $model->setAlias()->setUrl();
    }
}
