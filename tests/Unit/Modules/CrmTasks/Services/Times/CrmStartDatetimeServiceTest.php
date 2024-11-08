<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Services\Times\CrmStartDatetimeService;
use App\Modules\CrmTasks\Services\Times\CrmStartDatetimeService\StartDatetimeContext;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;
use Carbon\Carbon;
use Tests\TestCase;

class CrmStartDatetimeServiceTest extends TestCase
{
    private array $options;


    protected function setUp(): void
    {
        parent::setUp();

        $this->options = StartDatetimeContext::getOptionKeys();
        $this->assertNotEmpty($this->options);
    }

    public function testIfOneInvalidServiceOptionReturnAnEmptyString(): void
    {
        $service = new CrmStartDatetimeService('a invalid option key');
        $result = $service->get((string) now());
        $this->assertIsString($result);
        $this->assertEmpty($result);
    }

    public function testIfEachServiceOptionReturnOneValidDatetime(): void
    {
        $this->freezeDatetime('2024-03-05 12:00:00');
        $optionKey = 'Every 5th of March of each year';
        dump('Checking ' . $optionKey . '...');
        $service = new CrmStartDatetimeService($optionKey);
        $result = $service->get((string) now());
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $optionKey = 'Every 5th of each month';
        dump('Checking ' . $optionKey . '...');
        $service = new CrmStartDatetimeService($optionKey);
        $result = $service->get((string) now());
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $this->freezeDatetime('2024-03-18 12:00:00');
        $optionKey = 'Every Monday';
        dump('Checking ' . $optionKey . '...');
        $service = new CrmStartDatetimeService($optionKey);
        $result = $service->get((string) now());
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $optionKey = 'Every day';
        dump('Checking ' . $optionKey . '...');
        $service = new CrmStartDatetimeService($optionKey);
        $result = $service->get((string) now());
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $this->freezeDatetime('2024-03-20 12:00:00');
        $optionKey = 'Wednesday and Friday';
        dump('Checking ' . $optionKey . '...');
        $service = new CrmStartDatetimeService($optionKey);
        $result = $service->get((string) now());
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $this->freezeDatetime('2024-03-22 12:00:00');
        $optionKey = 'Wednesday and Friday';
        dump('Checking ' . $optionKey . '...');
        $service = new CrmStartDatetimeService($optionKey);
        $result = $service->get((string) now());
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));
    }


    /**
     * Freeze the time for predictable test results
     *
     */
    private function freezeDatetime(string $time): void
    {
        Carbon::setTestNow(Carbon::parse($time));
    }
}
