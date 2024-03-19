<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options;

use App\Modules\CrmTasks\Repositories\Data\Data;
use Carbon\Carbon;

class OneDay implements ExpirationTimeOptionInterface
{

    public static function get(string $timestamp): string
    {
        return Carbon::parse($timestamp)
            ->addDay()
            ->format(Data::DATE_TIME_FORMAT);
    }
}
