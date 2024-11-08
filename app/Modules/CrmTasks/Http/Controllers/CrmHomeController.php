<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Services\Actions\GetCrmUserTaskAction;
use Illuminate\Support\Facades\Auth;

class CrmHomeController extends CrmTaskMainController
{

    public function home()
    {
        $openTasks = (new GetCrmUserTaskAction(Auth::user()->id))->getOpenTasks();

        return view('pages.dashboard')
            ->with('tasks', $openTasks);
    }
}
