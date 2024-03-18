<?php

namespace App\Modules\CrmTasks\Services\Filters\FilterTasksService\Options;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface NextTasksOptionInterface
{
    public static function get(int $userId, bool $onlyOpen): EloquentCollection;
}
