<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\CrmStartTime;
use Database\Seeders\Modules\CrmTasks\Repositories\CrmStartTimeRepository;
use Illuminate\Database\Seeder;

class CrmStartTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = CrmStartTimeRepository::get();
        foreach ($data as $schedule) {
            CrmStartTime::create([
                'label' => $schedule,
            ]);
        }
    }
}
