<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options;

use App\Modules\CrmTasks\Repositories\Data\Data;
use Carbon\Carbon;

class EndOfMonth implements ExpirationTimeOptionInterface
{

    public static function get(string $timestamp): string
    {
        return Carbon::parse($timestamp)
            ->endOfMonth()
            ->format(Data::DATE_TIME_FORMAT);
    }
}
