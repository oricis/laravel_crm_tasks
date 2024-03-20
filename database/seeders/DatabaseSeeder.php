<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Modules\CrmTasks\CrmTasksSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (App::environment() !== 'production') {
            $this->call(UserSeeder::class);
        }
        $this->call(CrmTasksSeeder::class);
    }
}
