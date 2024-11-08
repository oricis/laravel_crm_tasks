<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Actions;

use App\Modules\CrmTasks\Models\CrmTaskGroup;
use App\Modules\CrmTasks\Services\Actions\CreateCrmTaskGroupAction;
use Tests\TestCase;

class CreateCrmTaskGroupActionTest extends TestCase
{
    private array $data;


    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'title'         => fake()->name(),
            'crm_task_group_id' => fake()->text(),
        ];
    }

    public function testTaskCreationWithAllRequiredData(): void
    {
        $result = (new CreateCrmTaskGroupAction($this->data))->create();
        $this->assertTrue($result);
        $this->assertEquals(
            $this->data['title'],
            CrmTaskGroup::latest()->first()->title
        );
    }

    public function testTaskCreationWithoutAllRequiredData(): void
    {
        unset($this->data['title']);
        $result = (new CreateCrmTaskGroupAction($this->data))->create();
        $this->assertFalse($result);
    }
}
