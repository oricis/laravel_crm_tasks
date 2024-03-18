<?php

namespace App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options;

use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Repositories\Data\Data;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskNextWeek implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $nextWeekStart = now()->startOfWeek()->addWeek();
        $startDate = $nextWeekStart
            ->format(Data::DATE_TIME_FORMAT);
        $endDate = $nextWeekStart->copy()->endOfWeek()
            ->format(Data::DATE_TIME_FORMAT);

        $queryBuilder = UserTask::query()
            ->whereAssignedTo($userId)
            ->whereBetween('expired_at', [$startDate, $endDate]);
        if ($onlyOpen) {
            $queryBuilder = $queryBuilder->whereNull('ended_at');
        }

        return $queryBuilder->get();
    }
}
