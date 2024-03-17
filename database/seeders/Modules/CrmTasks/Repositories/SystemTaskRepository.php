<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Services\Times\TimestampsService;

class SystemTaskRepository
{
    private static array $startTimeIds;
    private static array $tasks = [
        [
            'title' => 'Demo',
            'description' => 'This is a demo task',
            'task_group_id' => 1,
            'expired_at' => null,
        ],
        [
            'title' => 'Monthly revision',
            'task_group_id' => 1,
        ],
        [
            'title' => 'Daily meeting',
            'description' => 'The "Daily meeting" is important',
            'task_group_id' => 1,
        ],
    ];


    public static function get(): array
    {
        self::$startTimeIds = StartTime::get('id')->pluck('id')->toArray();

        $tasks = self::$tasks;
        foreach ($tasks as $key => $task) {
            if ($task['title'] === 'Monthly revision') {
                $task = self::addEndOfMonthTo($task);
            }
            $task = self::addStartTimeId($task);

            $tasks[$key] = $task;
        }

        return $tasks;
    }


    private static function addEndOfMonthTo(array $task): array
    {
        $task['expired_at'] = TimestampsService::getEndOfMonthTimestamp();

        return $task;
    }

    private static function addStartTimeId(array $task): array
    {
        $task['start_time_id']
            = self::$startTimeIds[rand(0, count(self::$startTimeIds) - 1)];

        return $task;
    }
}
