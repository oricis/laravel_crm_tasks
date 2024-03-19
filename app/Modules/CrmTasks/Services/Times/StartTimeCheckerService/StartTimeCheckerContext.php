<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Times\StartTimeCheckerService;

use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options\EveryDay;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options\EveryFiveOfEachMarch;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options\EveryFiveOfEachMonth;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options\EveryMonday;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService\Options\WednesdayAndFriday;
use App\Modules\CrmTasks\Services\Traits\ServiceContextAccessorTrait;

class StartTimeCheckerContext
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

    public function pass(): bool
    {
        return (new self::$options[$this->optionKey])->pass();
    }
}

