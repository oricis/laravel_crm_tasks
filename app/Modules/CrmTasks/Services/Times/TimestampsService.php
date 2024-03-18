<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Repositories\Data\Data;

class TimestampsService
{

    public static function getEndOfDayTimestamp(): string
    {
        return now()
            ->endOfDay()
            ->format(Data::DATE_TIME_FORMAT);
    }
    public static function getStartOfDayTimestamp(): string
    {
        return now()
            ->startOfDay()
            ->format(Data::DATE_TIME_FORMAT);
    }

    public static function getEndOfTomorrowTimestamp(): string
    {
        return now()
            ->endOfDay()
            ->addDay()
            ->format(Data::DATE_TIME_FORMAT);
    }
    public static function getStartOfTomorrowTimestamp(): string
    {
        return now()
            ->startOfDay()
            ->addDay()
            ->format(Data::DATE_TIME_FORMAT);
    }

    public static function getEndOfMonthTimestamp(): string
    {
        return now()
            ->endOfMonth()
            ->format(Data::DATE_TIME_FORMAT);
    }
    public static function getStartOfMonthTimestamp(): string
    {
        return now()
            ->startOfMonth()
            ->format(Data::DATE_TIME_FORMAT);
    }
}
