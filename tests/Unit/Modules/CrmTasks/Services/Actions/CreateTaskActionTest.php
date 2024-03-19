<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\ExpirationTime;
use App\Modules\CrmTasks\Models\StartTime;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Repositories\Data\Data;
use App\Modules\CrmTasks\Services\Actions\CreateTaskAction;
use Tests\TestCase;

class CreateTaskActionTest extends TestCase
{
    private array $data;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(ExpirationTime::exists());
        $this->assertTrue(StartTime::exists());
        $this->assertTrue(TaskGroup::exists());

        $this->data = [
            'title'        => fake()->name(),
            'task_group_id' => TaskGroup::get('id')->random()->id,
            'start_time_id' => StartTime::get('id')->random()->id,
            'expiration_time_id' => ExpirationTime::get('id')->random()->id,
            'start_at'     => now(),
            'expired_at'   => now()->addMonth()->format(Data::DATE_TIME_FORMAT),
        ];
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateTaskAction($this->data))->create();
        $this->assertTrue($result);
        $this->assertEquals(
            $this->data['title'],
            Task::latest()->first()->title
        );
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateTaskAction($this->data))->create();
        $this->assertFalse($result);
    }
}
