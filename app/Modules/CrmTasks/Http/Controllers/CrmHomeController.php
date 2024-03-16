<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Models\TimeFilter;

class CrmHomeController extends CrmTaskMainController
{

    public function home()
    {
        $timeFilters = TimeFilter::get([
            'id',
            'label',
            'description',
        ]);

        return view('dashboard')
            ->with('timeFilters', $timeFilters);
    }
}
