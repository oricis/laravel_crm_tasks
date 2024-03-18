<?php

namespace App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options;

use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskTomorrow implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $startDate = TimestampsService::getStartOfTomorrowTimestamp();
        $endDate = TimestampsService::getEndOfTomorrowTimestamp();

        $queryBuilder = UserTask::query()
            ->whereAssignedTo($userId)
            ->whereBetween('expired_at', [$startDate, $endDate]);
        if ($onlyOpen) {
            $queryBuilder = $queryBuilder->whereNull('ended_at');
        }

        return $queryBuilder->get();
    }
}
