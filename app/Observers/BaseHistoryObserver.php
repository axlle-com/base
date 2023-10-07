<?php

namespace App\Observers;

use App\Models\BaseModel;

abstract class BaseHistoryObserver
{

    public function created(BaseModel $model): void
    {
        $model->setHistory(__FUNCTION__);
    }

    public function updated(BaseModel $model): void
    {
        $model->setHistory(__FUNCTION__);
    }

    public function deleted(BaseModel $model): void
    {
        $model->setHistory(__FUNCTION__);
    }

    public function restored(BaseModel $model): void
    {
        $model->setHistory(__FUNCTION__);
    }

    public function forceDeleted(BaseModel $model): void
    {
        $model->setHistory(__FUNCTION__);
    }
}
