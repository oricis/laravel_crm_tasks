<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Models\User;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Actions\UpdateUserTaskAction;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateUserTaskActionTest extends TestCase
{
    private UserTask $userTask;
    private int $userId;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(UserTask::whereNull('ended_at')->exists());

        $this->userTask = UserTask::whereNull('ended_at')->first();

        // Login as
        Auth::login(User::find($this->userTask->assigned_to), false);
    }

    public function testIfOneUserCanCloseHisTask(): void
    {
        $result = (new UpdateUserTaskAction($this->userTask->id))
            ->close((string) now());

        $this->assertTrue($result);
    }
}

