<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\Task;

class CreateTaskAction
{
    private array $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function create(): bool
    {
        try {
            Task::create($this->data);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return true;
    }
}

