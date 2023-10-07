<?php

namespace App\Observers;

use App\Models\Post\Post;

class PostObserver extends BaseHistoryObserver
{
    /**
     * @param Post $model
     * @return void
     */
    public function creating(Post $model): void
    {
        $model->setAlias()->setUrl();
    }

    /**
     * @param Post $model
     * @return void
     */
    public function updating(Post $model): void
    {
        $model->setAlias()->setUrl();
    }
}
