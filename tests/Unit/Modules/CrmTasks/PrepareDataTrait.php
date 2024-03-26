<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks;

use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;

trait PrepareDataTrait
{

    private static function setTaskStartTime(
        CrmTask $task,
        string $label = 'Every day'
    ): CrmTask
    {
        $startTimeId = CrmStartTime::whereLabel($label)->first()->id;
        $task->update([
            'crm_start_time_id' => $startTimeId,
        ]);

        return $task;
    }
}
