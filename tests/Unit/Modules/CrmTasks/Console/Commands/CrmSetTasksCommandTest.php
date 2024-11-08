<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Console\Commands;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Models\CrmUserTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Tests\Unit\Modules\CrmTasks\PrepareDataTrait;

class CrmSetTasksCommandTest extends TestCase
{
    use PrepareDataTrait;

    private string $signature = 'crm:set-tasks';


    protected function setUp(): void
    {
        parent::setUp();

        if (! CrmExpirationTime::exists()) {
            Artisan::call('migrate:fresh --seed');
        }
    }

    public function testIfRunTheCommandAndGenerateUserTasks(): void
    {
        $this->assertNotNull($this->seedTask());
$this->seedAnActiveTask(); // BUG:
        $userTasksBefore = CrmUserTask::count();
        $this->assertEquals(0, Artisan::call($this->signature));
        $this->assertTrue($userTasksBefore < CrmUserTask::count());
    }


    private function seedAnActiveTask(): bool
    {
        try {
            CrmTask::create([
                'description' => fake()->text(90),
                'crm_expiration_time_id' => CrmExpirationTime::first()->id,
                'expired_at'  => now()->addHour()->format(CrmData::DATE_TIME_FORMAT),
                'start_at'    => (string) now(),
                'crm_start_time_id' => CrmStartTime::first()->id,
                'crm_task_group_id' => CrmTaskGroup::first()->id,
                'title'       => fake()->text(50),
            ]);
        } catch (\Exception $e) {
            dump(getExceptionStr($e));
            return false;
        }

        return true;
    }
}
