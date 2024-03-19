<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times;

use App\Exceptions\InvalidDataException;
use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\ExpirationDatetimeContext;
use App\Modules\CrmTasks\Services\Traits\ServiceContextValidationTrait;

class ExpirationDatetimeService
{
    use ServiceContextValidationTrait;

    private string $optionKey;


    public function __construct(string $optionKey)
    {
        $this->optionKey = $optionKey;
    }

    public function get(string $timestamp): string
    {
        try {
            if (!TimestampsService::isValidTimestampString($timestamp)) {
                $message = 'Invalid timestamp string: ' . $timestamp;
                throw new InvalidDataException($message);
            }
            $contextClass = ExpirationDatetimeContext::class;
            if (!self::isValidOptionKey($this->optionKey, $contextClass)) {
                $message = 'Invalid option key: ' . $this->optionKey;
                throw new InvalidDataException($message);
            }

            return (new ExpirationDatetimeContext($this->optionKey))
                ->get($timestamp);

        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return '';
        }
    }
}
