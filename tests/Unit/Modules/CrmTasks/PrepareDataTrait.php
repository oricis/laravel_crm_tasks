<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks;

use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Models\Task;

trait PrepareDataTrait
{

    private static function setTaskStartTime(
        Task $task,
        string $label = 'Every day'
    ): Task
    {
        $startTimeId = StartTime::whereLabel($label)->first()->id;
        $task->update([
            'start_time_id' => $startTimeId,
        ]);

        return $task;
    }
}
