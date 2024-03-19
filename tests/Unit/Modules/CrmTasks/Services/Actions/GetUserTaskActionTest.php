<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateUserTaskAction;
use Tests\TestCase;

class GetUserTaskActionTest extends TestCase
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
