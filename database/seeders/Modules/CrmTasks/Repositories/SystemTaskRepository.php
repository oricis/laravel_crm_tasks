<?php

declare(strict_types=1);

namespace Database\Seeders\Modules\CrmTasks\Repositories;

use App\Modules\CrmTasks\Services\Times\TimestampsService;

class SystemTaskRepository
{
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
        $tasks = self::$tasks;
        $tasks = self::addEndOfMonthTo($tasks, 'Monthly revision');

        return $tasks;
    }


    private static function addEndOfMonthTo(array $tasks, string $taskTitle): array
    {
        foreach ($tasks as $key => $task) {
            if ($task['title'] === $taskTitle) {
                $task['expired_at'] = TimestampsService::getEndOfMonthTimestamp();
            }
        }

        return $tasks;
    }
}
