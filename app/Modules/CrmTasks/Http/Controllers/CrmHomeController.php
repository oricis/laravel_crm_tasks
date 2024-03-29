<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Models\TimeFilter;
use App\Modules\CrmTasks\Services\Actions\GetUserTaskAction;
use Illuminate\Support\Facades\Auth;

class CrmHomeController extends CrmTaskMainController
{

    public function home()
    {
        $openTasks = (new GetUserTaskAction(Auth::user()->id))->getOpenTasks();

        return view('pages.dashboard')
            ->with('tasks', $openTasks);
    }
}
