<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmTaskGroup;

trait PrepareDataTrait
{

    private function seedTask(?array $data = null):? CrmTask
    {
        $data = $data
            ?? [
                'title' => fake()->text(50),
                'description' => fake()->text(90),
                'crm_start_time_id' => getRandomId(CrmStartTime::class),
                'crm_expiration_time_id' => getRandomId(CrmExpirationTime::class),
                'crm_task_group_id' => getRandomId(CrmTaskGroup::class),
                'start_at'   => (string) now(),
                'expired_at' => (string) now()->addYear(),
            ];

        try {
            return CrmTask::create($data);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return null;
        }
    }

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
