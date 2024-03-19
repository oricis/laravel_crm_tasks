<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times;

use App\Exceptions\InvalidDataException;
use App\Modules\CrmTasks\Services\Times\StartDatetimeService\StartDatetimeContext;
use App\Modules\CrmTasks\Services\Traits\ServiceContextValidationTrait;

class StartDatetimeService
{
    use ServiceContextValidationTrait;

    private string $optionKey;


    public function __construct(string $optionKey)
    {
        $this->optionKey = $optionKey;
    }

    public function get(): string
    {
        try {
            $contextClass = StartDatetimeContext::class;
            if (!self::isValidOptionKey($this->optionKey, $contextClass)) {
                $message = 'Invalid option key: ' . $this->optionKey;
                throw new InvalidDataException($message);
            }

            return (new StartDatetimeContext($this->optionKey))
                ->get();

        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return '';
        }
    }
}
