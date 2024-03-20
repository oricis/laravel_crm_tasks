<?php

namespace App\Livewire\CrmTasks\Selectors;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;

class UserTasksTimeFilter extends Component
{
    public EloquentCollection $timeFilters;
    public string $selectedFilterLabel;


    public function selectFilter(string $filterLabel): void
    {
        $this->selectedFilterLabel = $filterLabel;

        // emit event to reload filtered tasks
        $this->dispatch('reloadUserTasks', strFilter: $filterLabel);
    }

    public function render()
    {
        return view('livewire.crm-tasks.selectors.user-tasks-time-filter');
    }
}
