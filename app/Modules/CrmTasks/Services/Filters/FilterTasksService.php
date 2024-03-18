<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters;

use App\Modules\CrmTasks\Services\Filters\FilterTasksService\FilterTasksContext;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class FilterTasksService
{
    private bool $onlyOpen;
    private string $filter;


    public function __construct(string $filter, bool $onlyOpen = true)
    {
        $this->filter = $filter;
        $this->onlyOpen = $onlyOpen;
    }

    public function get(int $userId): EloquentCollection
    {
        return (new FilterTasksContext($this->filter, $this->onlyOpen))
            ->get($userId);
    }
}
