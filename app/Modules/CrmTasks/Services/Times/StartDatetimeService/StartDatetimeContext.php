<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\StartDatetimeService;

use App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options\EveryDay;
use App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options\EveryFiveOfEachMarch;
use App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options\EveryFiveOfEachMonth;
use App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options\EveryMonday;
use App\Modules\CrmTasks\Services\Times\StartDatetimeService\Options\WednesdayAndFriday;
use App\Modules\CrmTasks\Services\Traits\ServiceContextAccessorTrait;

class StartDatetimeContext
{
    use ServiceContextAccessorTrait; // add @getOptionKeys()

    private static array $options = [
        'Every 5th of March of each year' => EveryFiveOfEachMarch::class,
        'Every 5th of each month' => EveryFiveOfEachMonth::class,
        'Every Monday'         => EveryMonday::class,
        'Every day'            => EveryDay::class,
        'Wednesday and Friday' => WednesdayAndFriday::class,
    ];
    private string $optionKey;


    public function __construct(string $optionKey)
    {
        $this->optionKey = $optionKey;
    }

    public function get(): string
    {
        return (new self::$options[$this->optionKey])->get();
    }
}

