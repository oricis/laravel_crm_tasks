<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\CrmTask;
use Database\Seeders\Modules\CrmTasks\Repositories\CrmSystemTaskRepository;
use Illuminate\Database\Seeder;

class CrmTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = CrmSystemTaskRepository::get();
        foreach ($data as $task) {
            $taskData = [];
            foreach ($task as $field => $value) {
                $taskData[$field] = $value;
            }
            CrmTask::create($taskData);
        }
    }
}
