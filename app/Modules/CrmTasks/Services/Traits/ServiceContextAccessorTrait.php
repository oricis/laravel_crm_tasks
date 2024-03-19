<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Traits;

trait ServiceContextAccessorTrait
{

    public static function getOptionKeys(): array
    {
        return ($options = self::$options)
            ? array_keys($options)
            : [];
    }
}
