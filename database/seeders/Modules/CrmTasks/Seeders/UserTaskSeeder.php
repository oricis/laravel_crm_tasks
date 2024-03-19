<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Repositories\Data\Data;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use Illuminate\Database\Seeder;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expirationTimestamps = [
            TimestampsService::getEndOfMonthTimestamp(),
            TimestampsService::getEndOfTomorrowTimestamp(),
            now()->addDay()->format(Data::DATE_TIME_FORMAT),
            now()->addMonth()->addMonth()->format(Data::DATE_TIME_FORMAT),
            now()->addMonth()->format(Data::DATE_TIME_FORMAT),
        ];

        foreach (User::get() as $user) {
            foreach (Task::get() as $task) {
                $randomPosition = rand(0, count($expirationTimestamps) - 1);

                UserTask::create([
                    'title'         => $task->title,
                    'description'   => $task->description,
                    'task_group_id' => $task->task_group_id,
                    'created_at'    => now(),
                    'expired_at'    => $expirationTimestamps[$randomPosition],
                    'assigned_to'   => $user->id,
                ]);
            }
        }
    }
}
