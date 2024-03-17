<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Http\Requests\TaskFormRequest;
use App\Modules\CrmTasks\Models\ExpirationTime;
use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateTaskAction;

class CrmTaskController extends CrmTaskMainController
{

    public function get()
    {
        return view('pages.tasks')
            ->with('expirationTimes', ExpirationTime::get())
            ->with('formAction', route('create_system_tasks'))
            ->with('startTimes', StartTime::get())
            ->with('taskGroups', TaskGroup::get())
            ->with('tasks', Task::get());
    }

    public function create(TaskFormRequest $request)
    {
        return (new CreateTaskAction($request->validated()))->create()
            ? $this->get()
            : $this->goBackWithError();
    }
}
