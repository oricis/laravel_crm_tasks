<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Exceptions\ActionNotAllowedException;
use App\Exceptions\ModelNotFoundException;
use App\Modules\CrmTasks\Models\CrmUserTask;
use Illuminate\Support\Facades\Auth;

class UpdateCrmUserTaskAction
{
    private int $taskId;

    public function __construct(int $taskId)
    {
        $this->taskId = $taskId;
    }

    public function close(string $timestamp): bool
    {
        try {
            $userId = Auth::user()->id;

            $task = CrmUserTask::whereAssignedTo($userId)->find($this->taskId);
            if ($task->expired_at < $timestamp) {
                $message
                    = 'Task with ID: ' . $this->taskId . ' already expired!';
                throw new ActionNotAllowedException($message);
            }
            if (!$task) {
                $message = 'User task with ID: ' . $this->taskId . ' not found!
                    @uth user ID: ' . $userId;
                throw new ModelNotFoundException($message);
            }

            $task->update([
                'ended_at' => $timestamp,
            ]);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return true;
    }
}

