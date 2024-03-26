<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Models\User;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Services\Actions\UpdateCrmUserTaskAction;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateCrmUserTaskActionTest extends TestCase
{
    private CrmUserTask $userTask;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(CrmUserTask::whereNull('ended_at')->exists());

        $this->userTask = CrmUserTask::whereNull('ended_at')->first();

        // Login as
        Auth::login(User::find($this->userTask->assigned_to), false);
    }

    public function testIfOneUserCanCloseHisTask(): void
    {
        $result = (new UpdateCrmUserTaskAction($this->userTask->id))
            ->close((string) now());

        $this->assertTrue($result);
    }
}

