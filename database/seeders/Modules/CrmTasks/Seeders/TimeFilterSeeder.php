<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\TimeFilter;
use Database\Seeders\Modules\CrmTasks\Repositories\TimeFilterRepository;
use Illuminate\Database\Seeder;

class TimeFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeFilters = TimeFilterRepository::get();
        foreach ($timeFilters as $filter) {
            TimeFilter::create([
                'label' => $filter,
            ]);
        }
    }
}
