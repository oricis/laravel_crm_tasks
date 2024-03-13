<?php

namespace Database\Seeders\Modules\CrmTasks;

use Database\Seeders\Modules\CrmTasks\Seeders\StartTimeSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\TaskGroupSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\TaskSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\TimeFilterSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\UserTaskSeeder;
use Illuminate\Database\Seeder;

class CrmTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(StartTimeSeeder::class);
        $this->call(TaskGroupSeeder::class);
        $this->call(TimeFilterSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(UserTaskSeeder::class);
    }
}
