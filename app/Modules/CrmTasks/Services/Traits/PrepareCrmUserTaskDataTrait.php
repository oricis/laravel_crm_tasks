<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Traits;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Times\CrmExpirationDatetimeService;
use App\Modules\CrmTasks\Services\Times\CrmStartDatetimeService;
use App\Modules\CrmTasks\Services\Times\CrmStartTimeCheckerService;

trait PrepareCrmUserTaskDataTrait
{
    private static array $taskKeysToRemove = [
        'created_at',
        'crm_expiration_time_id',
        'id',
        'crm_start_time_id',
        'updated_at',
    ];


    public static function getExpirationTime(
        string $startAt,
        ?int $expirationTimeId = null
    ): string
    {
        $expirationTimeLabel
            = ($expirationTimeId
                && $expirationTime = CrmExpirationTime::find($expirationTimeId))
            ? $expirationTime->label
            : ''; // no expiration date

        return ($expirationTimeLabel)
            ? (new CrmExpirationDatetimeService($expirationTimeLabel))->get($startAt)
            : CrmData::MAX_MYSQL_TIMESTAMP;
    }

    public static function prepareUserTaskData(int $userId, CrmTask $task): array
    {
        if (is_null(CrmStartTime::find($task->crm_start_time_id))) {
            notice('It isn\'t time to start, task ID: ' . $task->id);
            return [];
        }
        $startTimeLabel = CrmStartTime::find($task->crm_start_time_id)->label;
        if (!(new CrmStartTimeCheckerService($startTimeLabel))->pass()) {
            notice('It isn\'t time to start: "' . $startTimeLabel . '"');
            return [];
        }

        $startAt = (new CrmStartDatetimeService($startTimeLabel))->get();
        $expiredAt
            = self::getExpirationTime($startAt, $task->crm_expiration_time_id);

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
