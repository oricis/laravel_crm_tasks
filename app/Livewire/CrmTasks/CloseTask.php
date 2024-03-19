<?php

namespace App\Livewire\CrmTasks;

use App\Modules\CrmTasks\Services\Actions\UpdateUserTaskAction;
use Livewire\Component;

class CloseTask extends Component
{
    public int $userTaskId;
    public ?string $endedAt;
    public string $expiredAt;


    public function close()
    {
        if ($result = (new UpdateUserTaskAction($this->userTaskId))
            ->close((string) now())) {
            logger('Closed user task ID: ' . $this->userTaskId);
            $this->endedAt = $result;
        }
    }

    public function render()
    {
        return view('livewire.crm-tasks.close-task');
    }
}
