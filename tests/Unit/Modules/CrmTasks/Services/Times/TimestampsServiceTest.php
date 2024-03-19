<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Times;

use App\Modules\CrmTasks\Repositories\Data\Data;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use Carbon\Carbon;
use Tests\TestCase;

class TimestampsServiceTest extends TestCase
{
    private string $today    = '2024-03-18';
    private string $tomorrow = '2024-03-19';


    protected function setUp(): void
    {
        parent::setUp();

        // Freeze the current time for predictable test results
        Carbon::setTestNow(Carbon::parse($this->today . ' 12:00:00'));
    }

    public function testEndOfDayTimestamp(): void
    {
        $expectedTimestamp = Carbon::parse($this->today . ' 23:59:59');
        $actualTimestamp = TimestampsService::getEndOfDayTimestamp();

        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );
    }

    public function testStartOfDayTimestamp(): void
    {
        $expectedTimestamp = Carbon::parse($this->today . ' 00:00:00');
        $actualTimestamp = TimestampsService::getStartOfDayTimestamp();

        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );
    }

    public function testEndOfTomorrowTimestamp(): void
    {
        $expectedTimestamp = Carbon::parse($this->tomorrow . ' 23:59:59');
        $actualTimestamp = TimestampsService::getEndOfTomorrowTimestamp();

        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );
    }

    public function testStartOfTomorrowTimestamp(): void
    {
        $expectedTimestamp = Carbon::parse($this->tomorrow . ' 00:00:00');
        $actualTimestamp = TimestampsService::getStartOfTomorrowTimestamp();

        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );
    }

    public function testEndOfMonthTimestamp(): void
    {
        // Test for end of March (31 days)

        $expectedTimestamp = Carbon::parse('2024-03-31 23:59:59');
        $actualTimestamp = TimestampsService::getEndOfMonthTimestamp();
        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );

        // Test for end of February (29 days in a leap year)

        Carbon::setTestNow(Carbon::parse('2024-02-15 12:00:00'));
        $expectedTimestamp = Carbon::parse('2024-02-29 23:59:59');
        $actualTimestamp = TimestampsService::getEndOfMonthTimestamp();
        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );
    }

    public function testStartOfMonthTimestamp(): void
    {
        // Test for start of March

        $expectedTimestamp = Carbon::parse('2024-03-01 00:00:00');
        $actualTimestamp = TimestampsService::getStartOfMonthTimestamp();
        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );

        // Test for start of February (29 days in a leap year)

        Carbon::setTestNow(Carbon::parse('2024-02-15 12:00:00'));
        $expectedTimestamp = Carbon::parse('2024-02-01 00:00:00');
        $actualTimestamp = TimestampsService::getStartOfMonthTimestamp();
        $this->assertEquals(
            $expectedTimestamp->format(Data::DATE_TIME_FORMAT),
            $actualTimestamp
        );
    }

    public function testIfTheTimestampStringIsValid(): void
    {
        $validStr = '2024-03-19 11:59:59';
        $invalidStr = 'invalid 2024-03-19';

        $this->assertTrue(TimestampsService::isValidTimestampString($validStr));
        $this->assertFalse(TimestampsService::isValidTimestampString($invalidStr));
    }
}
