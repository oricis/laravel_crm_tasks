<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateUserTaskAction;
use App\Modules\CrmTasks\Services\Traits\PrepareUserTaskDataTrait;
use Tests\TestCase;

class CreateUserTaskActionTest extends TestCase
{
    use PrepareUserTaskDataTrait;

    private Task $task;
    private array $data;
    private int $userId;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(Task::exists());
        $task = Task::query()
            ->where('created_at', '<=', now())
            ->where('expired_at', '>=', now())
            ->first();
        $this->assertNotNull($task, '>> There isn\'t any system active task <<');

        $this->userId = User::first()->id;
        $this->data = $this->prepareUserTaskData($this->userId, $task);
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateUserTaskAction($this->data))->create();
        $this->assertTrue($result);
        $this->assertEquals(
            $this->data['title'],
            Task::latest()->first()->title
        );
        $this->assertEquals(
            $this->data['title'],
            Task::latest()->first()->title
        );
        $this->assertEquals(
            $this->userId,
            Task::latest()->first()->assigned_to
        );
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateUserTaskAction($this->data))->create();
        $this->assertFalse($result);
    }
}

