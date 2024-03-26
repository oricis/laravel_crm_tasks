<?php

namespace Database\Seeders\Modules\CrmTasks\Seeders;

use App\Modules\CrmTasks\Models\CrmTimeFilter;
use Database\Seeders\Modules\CrmTasks\Repositories\CrmTimeFilterRepository;
use Illuminate\Database\Seeder;

class CrmTimeFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeFilters = CrmTimeFilterRepository::get();
        foreach ($timeFilters as $filter) {
            CrmTimeFilter::create([
                'label' => $filter,
            ]);
        }
    }
}
