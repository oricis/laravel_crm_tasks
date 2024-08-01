<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Actions\CreateCrmTaskAction;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreateCrmTaskActionTest extends TestCase
{
    private array $data;


    protected function setUp(): void
    {
        parent::setUp();

        if (!CrmExpirationTime::exists()) {
            Artisan::call('migrate:fresh --seed');
        }
        $this->assertTrue($this->init());
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $rowsBefore = CrmTask::count();
        $result = (new CreateCrmTaskAction($this->data))->create();
        $this->assertTrue($result);
        $this->assertTrue(CrmTask::count() === ($rowsBefore + 1));
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateCrmTaskAction($this->data))->create();
        $this->assertFalse($result);
    }


    private function init(): bool
    {
        try {
            $this->data = [
                'title'        => fake()->name(),
                'crm_task_group_id' => CrmTaskGroup::get('id')->random()->id,
                'crm_start_time_id' => CrmStartTime::get('id')->random()->id,
                'crm_expiration_time_id' => CrmExpirationTime::get('id')->random()->id,
                'start_at'     => now(),
                'expired_at'   => now()->addMonth()->format(CrmData::DATE_TIME_FORMAT),
            ];
        } catch (\Exception $e) {
            dump(getExceptionStr($e));
            return false;
        }

        return true;
    }
}
