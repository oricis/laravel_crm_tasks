<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmExpirationDatetimeService\Options;

use App\Modules\CrmTasks\Repositories\Data\CrmData;
use Carbon\Carbon;

class OneWeek implements ExpirationTimeOptionInterface
{

    public static function get(string $timestamp): string
    {
        return Carbon::parse($timestamp)
            ->addWeek()
            ->format(CrmData::DATE_TIME_FORMAT);
    }
}
