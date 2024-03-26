<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;
use Carbon\Carbon;

class CrmSystemTaskRepository
{
    private static array $expirationTimeIds;
    private static array $startTimeIds;
    private static array $tasks = [
        [
            'title'       => 'Demo',
            'description' => 'This is a demo task',
            'crm_task_group_id' => 1,
        ],
        [
            'title' => 'Monthly revision',
            'crm_task_group_id' => 1,
        ],
        [
            'title' => 'Daily meeting',
            'description' => 'The "Daily meeting" is important',
            'crm_task_group_id' => 1,
        ],
    ];


    public static function get(): array
    {
        self::$expirationTimeIds = CrmExpirationTime::get('id')->pluck('id')->toArray();
        self::$startTimeIds = CrmStartTime::get('id')->pluck('id')->toArray();

        $tasks = self::$tasks;
        foreach ($tasks as $key => $task) {
            if ($task['title'] === 'Monthly revision') {
                $task = self::addEndOfMonthTo($task);
            }
            if ($task['title'] === 'Demo') {
                $task = self::startNow($task);
                $task = self::addOneWeek($task);
            }

            $task = self::addExpirationTimeId($task);
            $task = self::addStartTimeId($task);

            $tasks[$key] = $task;
        }

        return $tasks;
    }


    private static function addEndOfMonthTo(
        array $task,
        string $attr = 'expired_at'
    ): array
    {
        $task[$attr] = CrmTimestampsService::getEndOfMonthTimestamp();

        return $task;
    }

    private static function addOneWeek(
        array $task,
        string $attr = 'expired_at'
    ): array
    {
        $task[$attr] = now()->addWeek()->format(CrmData::DATE_TIME_FORMAT);

        return $task;
    }

    private static function addExpirationTimeId(array $task): array
    {
        $task['crm_expiration_time_id']
            = self::$startTimeIds[rand(0, count(self::$expirationTimeIds) - 1)];

        return $task;
    }

    private static function addStartTimeId(array $task): array
    {
        $task['crm_start_time_id']
            = self::$startTimeIds[rand(0, count(self::$startTimeIds) - 1)];

        return $task;
    }

    private static function startNow(array $task): array
    {
        $task['start_at'] = now();

        return $task;
    }
}
