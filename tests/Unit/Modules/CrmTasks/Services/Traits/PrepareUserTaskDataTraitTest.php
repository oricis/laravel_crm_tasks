<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Traits;

use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Times\TimestampsService;
use App\Modules\CrmTasks\Services\Traits\PrepareUserTaskDataTrait;
use Tests\TestCase;

class PrepareUserTaskDataTraitTest extends TestCase
{
    use PrepareUserTaskDataTrait;

    private array $requiredFields;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(Task::exists());
        $this->assertTrue(User::exists());
    }

    public function testIfPrepareDataOkToCreateAnUserTask(): void
    {
        $task = Task::first();
        $userId = User::first()->id;
        $this->setRequiredModelFields($task);

        $result = $this->prepareUserTaskData($userId, $task);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $keys = array_keys($result);
        sort($keys);
        dump($this->requiredFields, $keys);
        $this->assertEquals($this->requiredFields, $keys);

        $this->assertTrue(
            TimestampsService::isValidTimestampString($result['expired_at']));
        $this->assertTrue(
            TimestampsService::isValidTimestampString($result['start_at']));
        $this->assertNotNull(User::find($result['assigned_to']));
    }


    private function setRequiredModelFields(Task $task): void
    {
        $fields = (new UserTask())->getFillable();
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