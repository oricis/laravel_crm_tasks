<?php

namespace App\Modules\CrmTasks\Http\Controllers;

use App\Modules\CrmTasks\Http\Requests\CrmTaskGroupFormRequest;
use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateCrmTaskGroupAction;

class CrmTaskGroupController extends CrmTaskMainController
{

    public function get()
    {
        return view('pages.task-groups')
            ->with('formAction', route('create_crm_task_groups'))
            ->with('taskGroups', CrmTaskGroup::get());
    }

    public function create(CrmTaskGroupFormRequest $request)
    {
        return (new CreateCrmTaskGroupAction($request->validated()))->create()
            ? $this->get()
            : $this->goBackWithError();
    }
}
