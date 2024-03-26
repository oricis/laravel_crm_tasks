<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Repositories\Data;

final readonly class CrmData
{
    public const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    public const DAYS_FOR_OLD = 7;
    public const MAX_MYSQL_TIMESTAMP = '2038-01-19 03:14:17'; // The Epochalypse
}
