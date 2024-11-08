<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options;

use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskNextMonth implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $nextMonthStart = now()->startOfMonth()->addMonth();
        $startDate = $nextMonthStart
            ->format(CrmData::DATE_TIME_FORMAT);
        $endDate = $nextMonthStart->copy()->endOfMonth()
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
