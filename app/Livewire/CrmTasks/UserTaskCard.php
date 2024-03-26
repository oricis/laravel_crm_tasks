<?php

namespace App\Livewire\CrmTasks;

use App\Modules\CrmTasks\Models\CrmUserTask;
use Livewire\Component;

class UserTaskCard extends Component
{
    public CrmUserTask $task;


    public function render()
    {
        return view('livewire.crm-tasks.user-task-card');
    }
}
