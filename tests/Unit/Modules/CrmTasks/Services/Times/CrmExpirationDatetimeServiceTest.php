<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Services\Times\CrmExpirationDatetimeService;
use App\Modules\CrmTasks\Services\Times\CrmExpirationDatetimeService\ExpirationDatetimeContext;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;
use Tests\TestCase;

class CrmExpirationDatetimeServiceTest extends TestCase
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
        $service = new CrmExpirationDatetimeService('a invalid option key');
        $result = $service->get((string) now());
        $this->assertIsString($result);
        $this->assertEmpty($result);
    }

    public function testIfEachServiceOptionReturnValidDatetime(): void
    {
        foreach ($this->options as $optionKey) {
            dump('Checking ' . $optionKey . '...');
            $service = new CrmExpirationDatetimeService($optionKey);

            $result = $service->get((string) now());
            $this->assertIsString($result);
            $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));
        }
    }
}
