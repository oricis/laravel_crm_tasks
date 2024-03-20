<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Models\User;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Actions\GetUserTaskAction;
use Tests\TestCase;

class GetUserTaskActionTest extends TestCase
{
    private int $userId;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(UserTask::exists());

        $this->userId = UserTask::first()->assigned_to;
    }

    public function testIfTheUserHasOpenTasks(): void
    {
        $result = (new GetUserTaskAction($this->userId))->getOpenTasks();
        $this->assertTrue($result->count() > 0);
    }
}
