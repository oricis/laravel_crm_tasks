<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService;
use App\Modules\CrmTasks\Services\Times\ExpirationDatetimeService\ExpirationDatetimeContext;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use Tests\TestCase;

class ExpirationDatetimeServiceTest extends TestCase
{
    private array $options;


    protected function setUp(): void
    {
        parent::setUp();

        $this->options = ExpirationDatetimeContext::getOptionKeys();
        $this->assertNotEmpty($this->options);
    }

    public function testIfOneInvalidServiceOptionReturnAnEmptyString(): void
    {
        $service = new ExpirationDatetimeService('a invalid option key');
        $result = $service->get((string) now());
        $this->assertIsString($result);
        $this->assertEmpty($result);
    }

    public function testIfEachServiceOptionReturnValidDatetime(): void
    {
        foreach ($this->options as $optionKey) {
            dump('Checking ' . $optionKey . '...');
            $service = new ExpirationDatetimeService($optionKey);

            $result = $service->get((string) now());
            $this->assertIsString($result);
            $this->assertTrue(TimestampsService::isValidTimestampString($result));
        }
    }
}
