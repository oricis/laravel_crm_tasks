<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\CrmStartTimeCheckerService\Options;

interface StartTimeOptionInterface
{
    public static function pass(): bool;
}
