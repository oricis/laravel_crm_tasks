<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options;

interface ExpirationTimeOptionInterface
{
    public static function get(string $timestamp): string;
}
