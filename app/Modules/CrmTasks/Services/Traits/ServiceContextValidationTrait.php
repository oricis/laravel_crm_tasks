<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Traits;

trait ServiceContextValidationTrait
{

    public function isValidOptionKey(string $key, string $contextClass): bool
    {
        $optionKeys = (method_exists($contextClass, 'getOptionKeys'))
            ? $contextClass::getOptionKeys()
            : [];

        return $optionKeys
            && in_array($key, $optionKeys, true);
    }
}


