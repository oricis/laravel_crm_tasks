<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Validations;

use App\Modules\CrmTasks\Repositories\Data\CrmData;

class CrmTimesValidationService
{

    public static function isValidTimestampString(string $strTimestamp): bool
    {
        $timestamp = strtotime($strTimestamp);
        if (is_numeric($timestamp)) {
            $formattedDate = date(CrmData::DATE_TIME_FORMAT, $timestamp);

            return $formattedDate === $strTimestamp;
        }

        return false;
    }
}
