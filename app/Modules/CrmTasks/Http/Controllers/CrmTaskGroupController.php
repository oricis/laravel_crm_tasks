<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Http\Requests\TaskGroupFormRequest;
use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateTaskGroupAction;

class CrmTaskGroupController extends CrmTaskMainController
{

    public function get()
    {
        return view('pages.task-groups')
            ->with('formAction', route('create_task_groups'))
            ->with('taskGroups', TaskGroup::get());
    }

    public function create(TaskGroupFormRequest $request)
    {
        return (new CreateTaskGroupAction($request->validated()))->create()
            ? $this->get()
            : $this->goBackWithError();
    }
}
