<?php

namespace App\Modules\CrmTasks\Services\Filters\FilterTasksService;

use App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options\TaskNext;
use App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options\TaskNextMonth;
use App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options\TaskNextWeek;
use App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options\TaskToday;
use App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options\TaskTomorrow;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class FilterTasksContext
{
    private bool $onlyOpen;
    private array $options = [
        'TASKS TODAY'      => TaskToday::class,
        'TASKS TOMORROW'   => TaskTomorrow::class,
        'TASKS NEXT WEEK'  => TaskNextWeek::class,
        'TASKS NEXT MONTH' => TaskNextMonth::class,
        'TASKS NEXT (ALL)' => TaskNext::class,
    ];
    private string $filter;


    public function __construct(string $filter, bool $onlyOpen)
    {
        $this->filter = $filter;
        $this->onlyOpen = $onlyOpen;
    }

    public function get(int $userId): EloquentCollection
    {
        return (isset($this->options[$this->filter]))
            ? (new $this->options[$this->filter])
                ->get($userId,  $this->onlyOpen)
            : new EloquentCollection;
    }
}
