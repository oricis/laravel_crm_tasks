<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\TaskGroup;
use Database\Seeders\Modules\CrmTasks\Repositories\TaskGroupRepository;
use Illuminate\Database\Seeder;

class TaskGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = TaskGroupRepository::get();
        foreach ($data as $group) {
            $groupData = [];
            foreach ($group as $field => $value) {
                $groupData[$field] = $value;
            }
            TaskGroup::create($groupData);
        }
    }
}
