<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\UserTask;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class GetUserTaskAction
{
    private int $userId;


    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    // TODO: refactor to use strategy on filter queries
    public function getOpenTasks(array $fields = []): EloquentCollection
    {
        $output = UserTask::query()
            ->whereAssignedTo($this->userId)
            ->whereNull('ended_at')
            ->get($fields ? $fields : '*');

        return $output;
    }
}

