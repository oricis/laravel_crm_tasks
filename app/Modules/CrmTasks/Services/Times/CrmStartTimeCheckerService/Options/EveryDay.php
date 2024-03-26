<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmStartTimeCheckerService\Options;

use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;

class EveryDay implements StartTimeOptionInterface
{

    public static function pass(): bool
    {
        return true;
    }
}
