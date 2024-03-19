<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Exceptions\ActionNotAllowedException;
use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\UserTask;

class CreateUserTaskAction
{
    private array $taskData;
    private string $exceptionMessage;


    public function __construct(Task $task, int $userId)
    {
        $this->initData($task->toArray(), $userId);
    }

    public function create(): bool
    {
        try {
            if ($this->exceptionMessage) {
                throw new ActionNotAllowedException($this->exceptionMessage);
            }

            UserTask::create($this->taskData);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return true;
    }


    private function initData(array $taskData, int $userId): void
    {
        if ($taskData['expired_at'] > now()
            || $taskData['created_at'] < now()) {
            $this->exceptionMessage = 'Task inactive. It can\'t be assigned';
            return;
        }
        if (!User::find($userId)) {
            $this->exceptionMessage = 'User with ID: ' . $userId . ' not found';
            return;
        }

        $taskData['assigned_to'] = $userId;

        $this->taskData = $taskData;
    }
}

