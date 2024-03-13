<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Modules\CrmTasks\CrmTasksSeeder;
use Database\Seeders\Modules\CrmTasks\StartTimeSeeder;
use Database\Seeders\Modules\CrmTasks\TaskGroupSeeder;
use Database\Seeders\Modules\CrmTasks\TaskSeeder;
use Database\Seeders\Modules\CrmTasks\TimeFilterSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(UserSeeder::class);
        $this->call(CrmTasksSeeder::class);
    }
}
