<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\StartTime;
use Database\Seeders\Modules\CrmTasks\Repositories\StartTimeRepository;
use Illuminate\Database\Seeder;

class StartTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = StartTimeRepository::get();
        foreach ($data as $schedule) {
            StartTime::create([
                'label' => $schedule,
            ]);
        }
    }
}
