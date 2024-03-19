<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times;

use App\Exceptions\InvalidDataException;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\StartTimeCheckerContext;
use App\Modules\CrmTasks\Services\Traits\ServiceContextValidationTrait;

class StartTimeCheckerService
{
    use ServiceContextValidationTrait;

    private string $optionKey;


    public function __construct(string $optionKey)
    {
        $this->optionKey = $optionKey;
    }

    public function pass(): bool
    {
        try {
            $contextClass = StartTimeCheckerContext::class;
            if (!self::isValidOptionKey($this->optionKey, $contextClass)) {
                $message = 'Invalid option key: ' . $this->optionKey;
                throw new InvalidDataException($message);
            }
            return (new StartTimeCheckerContext($this->optionKey))->pass();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return '';
        }
    }
}
