<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Traits;

use App\Models\User;
use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;
use App\Modules\CrmTasks\Services\Traits\PrepareCrmUserTaskDataTrait;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Tests\Unit\Modules\CrmTasks\PrepareDataTrait;

class PrepareCrmUserTaskDataTraitTest extends TestCase
{
    use PrepareDataTrait;
    use PrepareCrmUserTaskDataTrait;

    private array $requiredFields;


    protected function setUp(): void
    {
        parent::setUp();

        if (! User::exists()) {
            Artisan::call('migrate:fresh --seed');
        }

        if (!CrmTask::exists()) {
            $this->seedTask();
        }
    }

    public function testIfPrepareDataOkToCreateAnUserTask(): void
    {
        $task = self::setTaskStartTime(CrmTask::first());
        $userId = User::first()->id;
        $this->setRequiredModelFields($task);

        $result = self::prepareUserTaskData($userId, $task);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        $keys = array_keys($result);
        sort($keys);
        $this->assertEquals($this->requiredFields, $keys);

        $this->assertTrue(
            CrmTimestampsService::isValidTimestampString($result['expired_at']));
        $this->assertTrue(
            CrmTimestampsService::isValidTimestampString($result['start_at']));
        $this->assertNotNull(User::find($result['assigned_to']));
    }

    public function testIsGetValidExpirationDatetimes(): void
    {
        // function getExpirationTime(
        //     string $startAt,
        //     ?int $expirationTimeId
        // ): string

        $strNow = (string) now();

        $result = self::getExpirationTime($strNow);
        $this->assertIsString($result);
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $result = self::getExpirationTime($strNow, null);
        $this->assertIsString($result);
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $result = self::getExpirationTime($strNow, 0);
        $this->assertIsString($result);
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));

        $expirationTime = CrmExpirationTime::first('id');
        $this->assertNotNull($expirationTime);
        $result = self::getExpirationTime($strNow, $expirationTime->id);
        $this->assertIsString($result);
        $this->assertTrue(CrmTimestampsService::isValidTimestampString($result));
    }


    private function setRequiredModelFields(CrmTask $task): void
    {
        $fields = (new CrmUserTask())->getFillable();
        unset($fields[array_search('created_at', $fields)]);
        unset($fields[array_search('ended_at', $fields)]);
        if (!$task->description) {
            unset($fields[array_search('description', $fields)]);
        }
        $fields = array_merge($fields, ['start_at']);

        sort($fields);
        $this->requiredFields = array_values($fields);
    }
}
