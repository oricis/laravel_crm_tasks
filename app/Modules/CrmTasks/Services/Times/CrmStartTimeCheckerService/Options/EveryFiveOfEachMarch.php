<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmStartTimeCheckerService\Options;

class EveryFiveOfEachMarch implements StartTimeOptionInterface
{

    public static function pass(): bool
    {
        $carbon = now();

        return $carbon->month === 3
            && $carbon->day === 5;
    }
}
