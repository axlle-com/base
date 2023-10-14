<?php

namespace App\Models\Traits;

use App\Models\BaseModel;
use App\Models\History\History;
use App\Models\Ip;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder as Query;

trait HasHistory
{
    public bool $isHistory = true;

    public function scopeCreated(Query $query): Query
    {
        /** @var BaseModel $this */
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
