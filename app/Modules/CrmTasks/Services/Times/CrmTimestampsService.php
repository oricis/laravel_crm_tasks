<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Validations\CrmTimesValidationService;

class CrmTimestampsService
{

    public static function getEndOfDayTimestamp(): string
    {
        return now()
            ->endOfDay()
            ->format(CrmData::DATE_TIME_FORMAT);
    }
    public static function getStartOfDayTimestamp(): string
    {
        return now()
            ->startOfDay()
            ->format(CrmData::DATE_TIME_FORMAT);
    }

    public static function getEndOfTomorrowTimestamp(): string
    {
        return now()
            ->endOfDay()
            ->addDay()
            ->format(CrmData::DATE_TIME_FORMAT);
    }
    public static function getStartOfTomorrowTimestamp(): string
    {
        return now()
            ->startOfDay()
            ->addDay()
            ->format(CrmData::DATE_TIME_FORMAT);
    }

    public static function getEndOfMonthTimestamp(): string
    {
        return now()
            ->endOfMonth()
            ->format(CrmData::DATE_TIME_FORMAT);
    }
    public static function getStartOfMonthTimestamp(): string
    {
        return now()
            ->startOfMonth()
            ->format(CrmData::DATE_TIME_FORMAT);
    }

    public static function isValidTimestampString(string $strTimestamp): bool
    {
        return CrmTimesValidationService::isValidTimestampString($strTimestamp);
    }
}
