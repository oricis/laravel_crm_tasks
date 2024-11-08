<?php

namespace App\Livewire\CrmTasks;

use App\Modules\CrmTasks\Models\CrmTimeFilter;
use App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserTasks extends Component
{
    public EloquentCollection $tasks;
    public EloquentCollection $timeFilters;
    public bool $onlyOpen = true;
    public string $strFilter;
    protected $listeners = [
        'reloadUserTasks' => 'reloadUserTasks'
    ];

    public function boot()
    {
        $this->timeFilters = CrmTimeFilter::get([
            'id',
            'label',
            'description',
        ]);
        $this->strFilter = $this->timeFilters->last()->label;
    }

    public function reloadUserTasks(string $strFilter): void
    {
        $this->strFilter = $strFilter;
        $this->updateTasks();
    }

    public function render()
    {
        return view('livewire.crm-tasks.user-tasks');
    }

    public function updateTasks(): void
    {
        $this->tasks = (new CrmFilterTasksService($this->strFilter, $this->onlyOpen))
            ->get(Auth::user()->id);
    }
}
