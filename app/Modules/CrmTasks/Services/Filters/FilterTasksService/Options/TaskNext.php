<?php

namespace App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options;

use App\Modules\CrmTasks\Models\UserTask;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskNext implements NextTasksOptionInterface
{

    public static function get(int $userId, bool $onlyOpen): EloquentCollection
    {
        $queryBuilder = UserTask::query()
            ->whereAssignedTo($userId)
            ->where('expired_at', '>', (string) now());
        if ($onlyOpen) {
            $queryBuilder = $queryBuilder->whereNull('ended_at');
        }

        return $queryBuilder->get();
    }
}
