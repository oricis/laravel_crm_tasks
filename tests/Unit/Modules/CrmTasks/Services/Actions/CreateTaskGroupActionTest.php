<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\TaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateTaskGroupAction;
use Tests\TestCase;

class CreateTaskGroupActionTest extends TestCase
{
    private array $data;


    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'title'         => fake()->name(),
            'task_group_id' => fake()->text(),
        ];
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateTaskGroupAction($this->data))->create();
        $this->assertTrue($result);
        $this->assertEquals(
            $this->data['title'],
            TaskGroup::latest()->first()->title
        );
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateTaskGroupAction($this->data))->create();
        $this->assertFalse($result);
    }
}
