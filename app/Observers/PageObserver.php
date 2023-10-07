<?php

namespace App\Observers;

use App\Models\Page\Page;

class PageObserver extends BaseHistoryObserver
{
    /**
     * @param Page $model
     * @return void
     */
    public function creating(Page $model): void
    {
        $model->setAlias()->setUrl();
    }

    /**
     * @param Page $model
     * @return void
     */
    public function updating(Page $model): void
    {
        $model->setAlias()->setUrl();
    }
}
