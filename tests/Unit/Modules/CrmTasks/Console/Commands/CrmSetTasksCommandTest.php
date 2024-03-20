<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Console\Commands;

use App\Models\User;
use App\Modules\CrmTasks\Models\ExpirationTime;
use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Repositories\Data\Data;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CrmSetTasksCommandTest extends TestCase
{
    private string $signature = 'crm:set-tasks';


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(ExpirationTime::exists());
        $this->assertTrue(StartTime::exists());
        $this->assertTrue(TaskGroup::exists());
        $this->assertTrue(User::exists());
    }

    public function testIfRunTheCommandAndGenerateUserTasks(): void
    {
        $this->assertTrue($this->seedAnActiveTask());

        $userTasksBefore = UserTask::count();
        $this->assertEquals(0, Artisan::call($this->signature));
        $this->assertTrue($userTasksBefore < UserTask::count());
    }


    private function seedAnActiveTask(): bool
    {
        try {
            Task::create([
                'description' => fake()->text(90),
                'expiration_time_id' => ExpirationTime::first()->id,
                'expired_at'  => now()->addHour()->format(Data::DATE_TIME_FORMAT),
                'start_at'    => (string) now(),
                'start_time_id' => StartTime::first()->id,
                'task_group_id' => TaskGroup::first()->id,
                'title'       => fake()->text(50),
            ]);
        } catch (\Exception $e) {
            dump(getExceptionStr($e));
            return false;
        }

        return true;
    }
}
