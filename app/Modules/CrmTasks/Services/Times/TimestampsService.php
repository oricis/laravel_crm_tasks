<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Repositories\Data\Data;
use Carbon\Carbon;

class TimestampsService
{

    public static function getEndOfMonthTimestamp(): string
    {
        $currentDate = Carbon::now();

        return $currentDate
            ->endOfMonth()
            ->format(Data::DATE_TIME_FORMAT);
    }
}
