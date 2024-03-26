<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Models\User;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Services\Actions\CreateCrmUserTaskAction;
use App\Modules\CrmTasks\Services\Traits\PrepareCrmUserTaskDataTrait;
use Tests\TestCase;
use Tests\Unit\Modules\CrmTasks\PrepareDataTrait;

class CreateCrmUserTaskActionTest extends TestCase
{
    use PrepareDataTrait;
    use PrepareCrmUserTaskDataTrait;

    private array $data;
    private int $userId;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(CrmTask::exists());
        $task = CrmTask::query()
            ->where('start_at', '<=', (string) now())
            ->where('expired_at', '>=', (string) now())
            ->first();
        $this->assertNotNull($task, '>> Without appropriate tasks <<');

        $task = self::setTaskStartTime($task);
        $this->userId = User::first()->id;
        $this->data = self::prepareUserTaskData($this->userId, $task);
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateCrmUserTaskAction($this->data))->create();
        $this->assertTrue($result);

        $lastUserTask = CrmUserTask::latest()->first();
        $this->assertEquals($this->data['title'], $lastUserTask->title);
        $this->assertEquals($this->data['crm_task_group_id'], $lastUserTask->crm_task_group_id);
        $this->assertEquals($this->userId, $lastUserTask->assigned_to);
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateCrmUserTaskAction($this->data))->create();
        $this->assertFalse($result);
    }
}

