<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options;

use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskTomorrow implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $startDate = CrmTimestampsService::getStartOfTomorrowTimestamp();
        $endDate = CrmTimestampsService::getEndOfTomorrowTimestamp();

        $queryBuilder = CrmUserTask::query()
            ->whereAssignedTo($userId)
            ->whereBetween('expired_at', [$startDate, $endDate]);
        if ($onlyOpen) {
            $queryBuilder = $queryBuilder->whereNull('ended_at');
        }

        return $queryBuilder->get();
    }
}
