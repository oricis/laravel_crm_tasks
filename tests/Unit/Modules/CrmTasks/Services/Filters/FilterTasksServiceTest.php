<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Filters;

use App\Models\User;
use App\Modules\CrmTasks\Models\TimeFilter;
use App\Modules\CrmTasks\Models\UserTask;
use App\Modules\CrmTasks\Services\Filters\FilterTasksService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Tests\TestCase;

class FilterTasksServiceTest extends TestCase
{
    private int $userId;
    private string $invalidStrFilter;
    private string $validStrFilter;


    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(User::exists());
        $this->assertTrue(UserTask::where('expired_at', '>', now())->exists());
        $this->assertNotNull($this->getUserWithTasksOnTheFuture());

        $this->invalidStrFilter = 'Zzz';
        $this->userId = $this->getUserWithTasksOnTheFuture()->id;
        $this->validStrFilter = 'TASKS NEXT (ALL)';
    }

    public function testIfUseInvalidFilterBreakSomething(): void
    {
        $service = new FilterTasksService($this->invalidStrFilter);

        $result = $service->get($this->userId);
        $this->assertEquals(EloquentCollection::class, get_class($result));
        $this->assertCount(0, $result);
    }

    public function testIfUseInvalidFilterReturnsSomething(): void
    {
        $service = new FilterTasksService($this->invalidStrFilter);

        $result = $service->get($this->userId);
        $this->assertEquals(EloquentCollection::class, get_class($result));
        $this->assertCount(0, $result);
    }

    public function testIfUseTheValidFiltersBreakSomething(): void
    {
        $filters = TimeFilter::get('label');
        foreach ($filters as $filterLabel) {
            $service = new FilterTasksService($filterLabel->label);

            $result = $service->get($this->userId);
            $this->assertEquals(EloquentCollection::class, get_class($result));
        }
    }

    public function testIfUserHasOpenTasks(): void
    {
        $service = new FilterTasksService($this->validStrFilter);

        $result = $service->get($this->userId);
        $this->assertEquals(EloquentCollection::class, get_class($result));
        $this->assertTrue($result->count() > 0);
    }


    private function getUserWithTasksOnTheFuture():? User
    {
        $user = UserTask::query()
            ->where('expired_at', '>', now())
            ->first('assigned_to');

        return User::find($user->assigned_to);
    }
}
