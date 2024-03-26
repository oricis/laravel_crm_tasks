<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\CrmTaskGroup;
use Database\Seeders\Modules\CrmTasks\Repositories\CrmTaskGroupRepository;
use Illuminate\Database\Seeder;

class CrmTaskGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = CrmTaskGroupRepository::get();
        foreach ($data as $group) {
            $groupData = [];
            foreach ($group as $field => $value) {
                $groupData[$field] = $value;
            }
            CrmTaskGroup::create($groupData);
        }
    }
}
