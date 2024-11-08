<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options;

use App\Modules\CrmTasks\Models\CrmUserTask;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskNext implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $queryBuilder = CrmUserTask::query()
            ->whereAssignedTo($userId)
            ->where('expired_at', '>', (string) now());
        if ($onlyOpen) {
            $queryBuilder = $queryBuilder->whereNull('ended_at');
        }

        return $queryBuilder->get();
    }
}
