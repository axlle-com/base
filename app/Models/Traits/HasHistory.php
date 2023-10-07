<?php

namespace App\Models\Traits;

use App\Jobs\HistoryJob;
use App\Models\BaseModel;
use App\Models\History\History;
use App\Models\Ip;
use App\Models\User\User;
use Exception;
use Illuminate\Database\Eloquent\Builder as Query;

trait HasHistory
{
    public bool $isHistory = true;

    public function setHistory(string $event): self
    {
        /** @var $this BaseModel */
        if (!$this->isHistory) {
            return $this;
        }
        try {
            $data = [
                'ip' => User::auth()->ip ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                'user_id' => User::auth()->id ?? null,
                'resource' => $this->getTable(),
                'resource_id' => $this->id,
                'event' => $event,
                'body' => @json_encode($this->getDirty(), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
                'created_at' => time(),
            ];
            HistoryJob::dispatch($data);
        } catch (Exception $exception) {
        }

        return $this;
    }

    public function scopeCreated(Query $query): Query
    {
        /** @var $this BaseModel */
        $table = $this->getTable();
        $query->addSelect([
            $table . '.*',
            User::table('first_name') . ' as user_first_name',
            User::table('last_name') . ' as user_last_name',
            Ip::table('ip') . ' as ip',
        ])
            ->leftJoin(History::table(), static function ($join) use ($table) {
                /** @var Query $join */
                $join->on(History::table('resource_id'), '=', $table . '.id')
                    ->where(History::table('resource'), '=', $table)
                    ->where(History::table('event'), '=', 'created');
            })
            ->leftJoin(User::table(), History::table('user_id'), '=', User::table('id'))
            ->leftJoin(Ip::table(), History::table('ip_id'), '=', Ip::table('id'));
        return $query;
    }
}
