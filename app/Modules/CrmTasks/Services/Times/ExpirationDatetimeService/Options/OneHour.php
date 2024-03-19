<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options;

use App\Modules\CrmTasks\Repositories\Data\Data;
use Carbon\Carbon;

class OneHour implements ExpirationTimeOptionInterface
{

    public static function get(string $timestamp): string
    {
        return Carbon::parse($timestamp)
            ->addHour()
            ->format(Data::DATE_TIME_FORMAT);
    }
}
