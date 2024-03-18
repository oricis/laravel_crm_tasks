<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\UserTask;

class CreateUserTaskAction
{
    private array $data;


    public function __construct(Task $task, int $userId)
    {
        $data = $task->toArray();
        $data['assigned_to'] = $userId;
        $this->data = $data;
    }

    public function create(): bool
    {
        try {
            UserTask::create($this->data);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return true;
    }



    public function getOpenTasks(type $parameter): type
    {
        $output = [];

        return $output;
    }
}

