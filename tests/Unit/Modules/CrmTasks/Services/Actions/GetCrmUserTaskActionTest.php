<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Services\Actions\GetCrmUserTaskAction;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GetCrmUserTaskActionTest extends TestCase
{
    private int $userId;


    protected function setUp(): void
    {
        parent::setUp();

        if (! CrmExpirationTime::exists()) {
            Artisan::call('migrate:fresh --seed');
        }
        $this->userId = CrmUserTask::first()->assigned_to;
    }

    public function testIfTheUserHasOpenTasks(): void
    {
        $result = (new GetCrmUserTaskAction($this->userId))->getOpenTasks();
        $this->assertTrue($result->count() > 0);
    }
}
