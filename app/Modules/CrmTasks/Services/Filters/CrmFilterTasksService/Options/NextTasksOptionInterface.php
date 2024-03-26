<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters\CrmFilterTasksService\Options;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface NextTasksOptionInterface
{
    public static function get(int $userId, bool $onlyOpen): EloquentCollection;
}
