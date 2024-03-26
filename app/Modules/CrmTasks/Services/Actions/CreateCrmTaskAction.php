<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\CrmTask;

class CreateCrmTaskAction
{
    private array $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function create(): bool
    {
        try {
            CrmTask::create($this->data);
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return true;
    }
}

