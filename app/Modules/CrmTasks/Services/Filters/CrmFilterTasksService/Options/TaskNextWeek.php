<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options;

use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskNextWeek implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $nextWeekStart = now()->startOfWeek()->addWeek();
        $startDate = $nextWeekStart
            ->format(CrmData::DATE_TIME_FORMAT);
        $endDate = $nextWeekStart->copy()->endOfWeek()
            ->format(CrmData::DATE_TIME_FORMAT);

        $queryBuilder = CrmUserTask::query()
            ->whereAssignedTo($userId)
            ->whereBetween('expired_at', [$startDate, $endDate]);
        if ($onlyOpen) {
            $queryBuilder = $queryBuilder->whereNull('ended_at');
        }

        return $queryBuilder->get();
    }
}
