<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Models\Task;
use Database\Seeders\Modules\CrmTasks\Repositories\SystemTaskRepository;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = SystemTaskRepository::get();
        foreach ($data as $task) {
            $taskData = [];
            foreach ($task as $field => $value) {
                $taskData[$field] = $value;
            }
            Task::create($taskData);
        }
    }
}
