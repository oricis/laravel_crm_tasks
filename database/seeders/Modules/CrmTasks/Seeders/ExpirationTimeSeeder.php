<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\ExpirationTime;
use Database\Seeders\Modules\CrmTasks\Repositories\ExpirationTimeRepository;
use Illuminate\Database\Seeder;

class ExpirationTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ExpirationTimeRepository::get();
        foreach ($data as $schedule) {
            ExpirationTime::create([
                'label' => $schedule,
            ]);
        }
    }
}
