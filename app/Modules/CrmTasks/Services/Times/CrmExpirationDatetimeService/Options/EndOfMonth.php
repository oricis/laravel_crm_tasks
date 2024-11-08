<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmExpirationDatetimeService\Options;

use App\Modules\CrmTasks\Repositories\Data\CrmData;
use Carbon\Carbon;

class EndOfMonth implements ExpirationTimeOptionInterface
{

    public static function get(string $timestamp): string
    {
        return Carbon::parse($timestamp)
            ->endOfMonth()
            ->format(CrmData::DATE_TIME_FORMAT);
    }
}
