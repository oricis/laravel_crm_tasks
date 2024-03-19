<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options;

use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Repositories\Data\Data;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskNextMonth implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $nextMonthStart = now()->startOfMonth()->addMonth();
        $startDate = $nextMonthStart
            ->format(Data::DATE_TIME_FORMAT);
        $endDate = $nextMonthStart->copy()->endOfMonth()
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
