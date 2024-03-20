<?php

namespace App\Livewire\CrmTasks;

use App\Modules\CrmTasks\Models\UserTask;
use Livewire\Component;

class UserTaskCard extends Component
{
    public UserTask $task;


    public function render()
    {
        return view('livewire.crm-tasks.user-task-card');
    }
}
