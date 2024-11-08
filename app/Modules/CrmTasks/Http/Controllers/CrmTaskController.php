<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Http\Requests\CrmTaskFormRequest;
use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateCrmTaskAction;

class CrmTaskController extends CrmTaskMainController
{

    public function get()
    {
        return view('pages.tasks')
            ->with('expirationTimes', CrmExpirationTime::get())
            ->with('formAction', route('create_crm_system_tasks'))
            ->with('startTimes', CrmStartTime::get())
            ->with('taskGroups', CrmTaskGroup::get())
            ->with('tasks', CrmTask::get());
    }

    public function create(CrmTaskFormRequest $request)
    {
        return (new CreateCrmTaskAction($request->validated()))->create()
            ? $this->get()
            : $this->goBackWithError();
    }
}
