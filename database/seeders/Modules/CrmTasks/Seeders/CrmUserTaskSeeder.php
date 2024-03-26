<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Models\User;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;
use Illuminate\Database\Seeder;

class CrmUserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expirationTimestamps = [
            CrmTimestampsService::getEndOfMonthTimestamp(),
            CrmTimestampsService::getEndOfTomorrowTimestamp(),
            now()->addDay()->format(CrmData::DATE_TIME_FORMAT),
            now()->addMonth()->addMonth()->format(CrmData::DATE_TIME_FORMAT),
            now()->addMonth()->format(CrmData::DATE_TIME_FORMAT),
        ];

        foreach (User::get() as $user) {
            foreach (CrmTask::get() as $task) {
                $randomPosition = rand(0, count($expirationTimestamps) - 1);

                CrmUserTask::create([
                    'title'         => $task->title,
                    'description'   => $task->description,
                    'crm_task_group_id' => $task->crm_task_group_id,
                    'created_at'    => now(),
                    'expired_at'    => $expirationTimestamps[$randomPosition],
                    'assigned_to'   => $user->id,
                ]);
            }
        }
    }
}
