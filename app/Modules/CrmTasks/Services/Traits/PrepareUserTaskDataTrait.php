<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Traits;

use App\Modules\CrmTasks\Models\ExpirationTime;
use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Repositories\Data\Data;
use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService;
use App\Modules\CrmTasks\Services\Times\StartDatetimeService;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService;

trait PrepareUserTaskDataTrait
{
    private array $taskKeysToRemove = [
        'created_at',
        'expiration_time_id',
        'id',
        'start_time_id',
        'updated_at',
    ];


    public function prepareUserTaskData(int $userId, Task $task): array
    {
        $startTimeLabel = StartTime::find($task->start_time_id)->label;
        if (!(new StartTimeCheckerService($startTimeLabel))->pass()) {
            notice('It isn\'t time to start: "' . $startTimeLabel . '"');
        }
        $startAt = (new StartDatetimeService($startTimeLabel))->get();

        $expirationTimeLabel
            = ($expirationTime = ExpirationTime::find($task->expiration_time_id))
            ? $expirationTime->label
            : ''; // no expiration date

        $expiredAt = ($expirationTimeLabel)
            ? (new ExpirationDatetimeService($expirationTimeLabel))->get($startAt)
            : now()->addYears(100)->format(Data::DATE_TIME_FORMAT);


        $output = removeArrElementsByIndex(
            $task->toArray(),
            $this->taskKeysToRemove
        );

        $output = array_merge(
            $output, [
                'assigned_to' => $userId,
                'start_at'    => $startAt,
                'expired_at'  => $expiredAt,
            ]
        );

        return $output;
    }
}
