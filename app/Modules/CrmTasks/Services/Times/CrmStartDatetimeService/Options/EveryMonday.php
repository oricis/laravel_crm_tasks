<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmStartDatetimeService\Options;

use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;

class EveryMonday implements StartTimeOptionInterface
{

    public static function get(): string
    {
        return now()->isMonday()
            ? CrmTimestampsService::getStartOfDayTimestamp()
            : '';
    }
}
