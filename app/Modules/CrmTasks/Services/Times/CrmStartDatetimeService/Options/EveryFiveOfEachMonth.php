<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmStartDatetimeService\Options;

use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;

class EveryFiveOfEachMonth implements StartTimeOptionInterface
{

    public static function get(): string
    {
        return (now()->day === 5)
            ? CrmTimestampsService::getStartOfDayTimestamp()
            : '';
    }
}
