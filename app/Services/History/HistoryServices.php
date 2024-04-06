<?php

namespace App\Services\History;

use App\Jobs\HistoryJob;
use App\Models\BaseModel;
use App\Models\User\User;
use Exception;

class HistoryServices
{
    /**
     * @param BaseModel $model
     * @param string $event
     * @return void
     */
    public function addQueue(BaseModel $model, string $event): void
    {
        try {
            $data = [
                'ip' => User::auth()->ip ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                'user_id' => User::auth()->id ?? null,
                'resource' => $model->getTable(),
                'resource_id' => $model->id,
                'event' => $event,
                'body' => @json_encode(
                    $model->getDirty(),
                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK
                ),
                'created_at' => time(),
            ];
            HistoryJob::dispatch($data);
        } catch (Exception $exception) {
        }
    }
}
