<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options;

use App\Modules\CrmTasks\Services\Times\TimestampsService;

class EveryFiveOfEachMonth implements StartTimeOptionInterface
{

    public static function get(): string
    {
        return (now()->day === 5)
            ? TimestampsService::getStartOfDayTimestamp()
            : '';
    }
}
