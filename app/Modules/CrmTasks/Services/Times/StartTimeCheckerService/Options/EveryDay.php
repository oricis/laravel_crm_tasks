<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options;

use App\Modules\CrmTasks\Services\Times\TimestampsService;

class EveryDay implements StartTimeOptionInterface
{

    public static function pass(): bool
    {
        return true;
    }
}
