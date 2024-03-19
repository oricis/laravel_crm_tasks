<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options;

use App\Modules\CrmTasks\Repositories\Data\Data;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use Carbon\Carbon;

class EveryFiveOfEachMarch implements StartTimeOptionInterface
{

    public static function get(): string
    {
        $carbon = now();

        return ($carbon->month === 3
            && $carbon->day === 5)
            ? TimestampsService::getStartOfDayTimestamp()
            : '';
    }
}
