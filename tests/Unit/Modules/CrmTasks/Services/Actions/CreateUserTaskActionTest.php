<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Actions\CreateUserTaskAction;
use App\Modules\CrmTasks\Services\Traits\PrepareUserTaskDataTrait;
use Tests\TestCase;

class CreateUserTaskActionTest extends TestCase
{
    use PrepareUserTaskDataTrait;

    private array $data;
    private int $userId;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(Task::exists());
        $task = Task::query()
            ->where('start_at', '<=', (string) now())
            ->where('expired_at', '>=', (string) now())
            ->first();
        $this->assertNotNull($task, '>> Without appropriate tasks <<');

        $this->userId = User::first()->id;
        $this->data = self::prepareUserTaskData($this->userId, $task);
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateUserTaskAction($this->data))->create();
        $this->assertTrue($result);

        $lastUserTask = UserTask::latest()->first();
        $this->assertEquals($this->data['title'], $lastUserTask->title);
        $this->assertEquals($this->data['task_group_id'], $lastUserTask->task_group_id);
        $this->assertEquals($this->userId, $lastUserTask->assigned_to);
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateUserTaskAction($this->data))->create();
        $this->assertFalse($result);
    }
}

