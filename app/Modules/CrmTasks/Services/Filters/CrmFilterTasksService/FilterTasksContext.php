<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService;

use App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options\TaskNext;
use App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options\TaskNextMonth;
use App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options\TaskNextWeek;
use App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options\TaskToday;
use App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options\TaskTomorrow;
use App\Modules\CrmTasks\Services\Traits\ServiceContextAccessorTrait;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class FilterTasksContext
{
    use ServiceContextAccessorTrait; // add @getOptionKeys()

    private bool $onlyOpen;
    private static array $options = [
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
        return (new self::$options[$this->filter])
            ->get($userId,  $this->onlyOpen);
    }
}
