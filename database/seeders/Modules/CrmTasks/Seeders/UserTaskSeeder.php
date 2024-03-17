<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use Illuminate\Database\Seeder;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::get() as $user) {
            foreach (Task::get() as $task) {
                $expiredAt = $task->expired_at
                    ?? TimestampsService::getEndOfMonthTimestamp();

                UserTask::create([
                    'title'         => $task->title,
                    'description'   => $task->description,
                    'task_group_id' => $task->task_group_id,
                    'created_at'    => now(),
                    'expired_at'    => $expiredAt,
                    'assigned_to'   => $user->id,
                ]);
            }
        }
    }
}
