<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService;

use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options\EndOfMonth;
use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options\OneDay;
use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options\OneHour;
use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\Options\OneWeek;
use App\Modules\CrmTasks\Services\Traits\ServiceContextAccessorTrait;

class ExpirationDatetimeContext
{
    use ServiceContextAccessorTrait; // add @getOptionKeys()

    private static array $options = [
        'One hour'     => OneHour::class,
        'One day'      => OneDay::class,
        'One week'     => OneWeek::class,
        'End of month' => EndOfMonth::class,
    ];
    private string $optionKey;


    public function __construct(string $optionKey)
    {
        $this->optionKey = $optionKey;
    }

    public function get(string $timestamp): string
    {
        return (new self::$options[$this->optionKey])->get($timestamp);
    }
}

