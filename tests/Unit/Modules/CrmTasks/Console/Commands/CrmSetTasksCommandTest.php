<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Console\Commands;

use App\Models\User;
use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CrmSetTasksCommandTest extends TestCase
{
    private string $signature = 'crm:set-tasks';


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(CrmExpirationTime::exists());
        $this->assertTrue(CrmStartTime::exists());
        $this->assertTrue(TaskGroup::exists());
        $this->assertTrue(User::exists());
    }

    public function testIfRunTheCommandAndGenerateUserTasks(): void
    {
        $this->assertTrue($this->seedAnActiveTask());

        $userTasksBefore = CrmUserTask::count();
        $this->assertEquals(0, Artisan::call($this->signature));
        $this->assertTrue($userTasksBefore < UserTask::count());
    }


    private function seedAnActiveTask(): bool
    {
        try {
            Task::create([
                'description' => fake()->text(90),
                'crm_expiration_time_id' => CrmExpirationTime::first()->id,
                'expired_at'  => now()->addHour()->format(CrmData::DATE_TIME_FORMAT),
                'start_at'    => (string) now(),
                'crm_start_time_id' => CrmStartTime::first()->id,
                'crm_task_group_id' => TaskGroup::first()->id,
                'title'       => fake()->text(50),
            ]);
        } catch (\Exception $e) {
            dump(getExceptionStr($e));
            return false;
        }

        return true;
    }
}
