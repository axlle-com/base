<?php

namespace App\Observers;

use App\Models\BaseModel;
use App\Services\History\HistoryServices;

abstract class BaseHistoryObserver
{
    protected HistoryServices $historyServices;

    /**
     * @param HistoryServices $historyServices
     */
    public function __construct(HistoryServices $historyServices)
    {
        $this->historyServices = $historyServices;
    }

    public function created(BaseModel $model): void
    {
        if (!empty($model->isHistory)) {
            $this->historyServices->addQueue($model, __FUNCTION__);
        }
    }

    public function updated(BaseModel $model): void
    {
        if (!empty($model->isHistory)) {
            $this->historyServices->addQueue($model, __FUNCTION__);
        }
    }

    public function deleted(BaseModel $model): void
    {
        if (!empty($model->isHistory)) {
            $this->historyServices->addQueue($model, __FUNCTION__);
        }
    }

    public function restored(BaseModel $model): void
    {
        if (!empty($model->isHistory)) {
            $this->historyServices->addQueue($model, __FUNCTION__);
        }
    }

    public function forceDeleted(BaseModel $model): void
    {
        if (!empty($model->isHistory)) {
            $this->historyServices->addQueue($model, __FUNCTION__);
        }
    }
}
