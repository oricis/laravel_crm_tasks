<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\CrmExpirationTime;
use App\Modules\CrmTasks\Models\CrmStartTime;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Actions\CreateCrmTaskAction;
use Tests\TestCase;

class CreateCrmTaskActionTest extends TestCase
{
    private array $data;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(CrmExpirationTime::exists());
        $this->assertTrue(CrmStartTime::exists());
        $this->assertTrue(CrmTaskGroup::exists());

        $this->data = [
            'title'        => fake()->name(),
            'crm_task_group_id' => CrmTaskGroup::get('id')->random()->id,
            'crm_start_time_id' => CrmStartTime::get('id')->random()->id,
            'crm_expiration_time_id' => CrmExpirationTime::get('id')->random()->id,
            'start_at'     => now(),
            'expired_at'   => now()->addMonth()->format(CrmData::DATE_TIME_FORMAT),
        ];
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateCrmTaskAction($this->data))->create();
        $this->assertTrue($result);
        $this->assertEquals(
            $this->data['title'],
            CrmTask::latest()->first()->title
        );
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateCrmTaskAction($this->data))->create();
        $this->assertFalse($result);
    }
}
