<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Exceptions\ActionNotAllowedException;
use App\Models\User;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Services\Validations\CrmTaskValidationService;

class CreateCrmUserTaskAction
{
    private array $taskData;
    private bool $pass = false;
    private string $exceptionMessage;


    public function __construct(array $data)
    {
        $this->setData($data);
    }

    public function create(): bool
    {
        try {
            if (!$this->pass) {
                throw new ActionNotAllowedException($this->exceptionMessage);
            }

            CrmUserTask::create($this->taskData);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return true;
    }


    private function setData(array $taskData): void
    {
        if (!CrmTaskValidationService::isTaskActive($taskData)) {
            $this->exceptionMessage = 'Task "' . $taskData['title']
                . '" inactive. It can\'t be assigned';
            return;
        }
        $userId = $taskData['assigned_to'];
        if (is_null(User::find($userId))) {
            $this->exceptionMessage = 'User with ID: ' . $userId . ' not found';
            return;
        }
        $this->pass = true;

        $this->taskData = $taskData;
    }
}

