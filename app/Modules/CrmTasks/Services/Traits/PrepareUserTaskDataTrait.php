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
    private static array $taskKeysToRemove = [
        'created_at',
        'expiration_time_id',
        'id',
        'start_time_id',
        'updated_at',
    ];


    public static function getExpirationTime(
        string $startAt,
        ?int $expirationTimeId = null
    ): string
    {
        $expirationTimeLabel
            = ($expirationTimeId
                && $expirationTime = ExpirationTime::find($expirationTimeId))
            ? $expirationTime->label
            : ''; // no expiration date

        return ($expirationTimeLabel)
            ? (new ExpirationDatetimeService($expirationTimeLabel))->get($startAt)
            : Data::MAX_MYSQL_TIMESTAMP;
    }

    public static function prepareUserTaskData(int $userId, Task $task): array
    {
        $startTimeLabel = StartTime::find($task->start_time_id)->label;
        if (!(new StartTimeCheckerService($startTimeLabel))->pass()) {
            notice('It isn\'t time to start: "' . $startTimeLabel . '"');
            return [];
        }

        $startAt = (new StartDatetimeService($startTimeLabel))->get();
        $expiredAt
            = self::getExpirationTime($startAt, $task->expiration_time_id);

        $output = removeArrElementsByIndex(
            $task->toArray(),
            self::$taskKeysToRemove
        );

        return array_merge(
            $output, [
                'assigned_to' => $userId,
                'start_at'    => $startAt,
                'expired_at'  => $expiredAt,
            ]
        );
    }
}
