<?php

namespace Database\Seeders\Modules\CrmTasks;

use Database\Seeders\Modules\CrmTasks\Seeders\CrmExpirationTimeSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\CrmStartTimeSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\CrmTaskGroupSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\CrmTaskSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\CrmTimeFilterSeeder;
use Database\Seeders\Modules\CrmTasks\Seeders\CrmUserTaskSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CrmTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedBaseCrmTasksTables();
        if (App::environment() !== 'production') {
            $this->seedDemoCrmTasksTables();
        }
    }


    private function seedBaseCrmTasksTables(): void
    {
        $this->call(CrmExpirationTimeSeeder::class);
        $this->call(CrmStartTimeSeeder::class);
        $this->call(CrmTimeFilterSeeder::class);
    }

    private function seedDemoCrmTasksTables(): void
    {
        $this->call(CrmTaskGroupSeeder::class);
            $this->call(CrmTaskSeeder::class);
            $this->call(CrmUserTaskSeeder::class);
    }
}
