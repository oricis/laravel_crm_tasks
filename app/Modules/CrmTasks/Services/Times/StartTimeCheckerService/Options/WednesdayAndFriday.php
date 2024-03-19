<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options;

class WednesdayAndFriday implements StartTimeOptionInterface
{

    public static function pass(): bool
    {
        return now()->isWednesday()
            || now()->isFriday();
    }
}
