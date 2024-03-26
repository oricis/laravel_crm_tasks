<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use Database\Seeders\Modules\CrmTasks\Repositories\CrmExpirationTimeRepository;
use Illuminate\Database\Seeder;

class CrmExpirationTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = CrmExpirationTimeRepository::get();
        foreach ($data as $schedule) {
            CrmExpirationTime::create([
                'label' => $schedule,
            ]);
        }
    }
}
