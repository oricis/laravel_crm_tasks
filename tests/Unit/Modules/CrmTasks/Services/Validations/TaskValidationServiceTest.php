<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Validations;

use App\Modules\CrmTasks\Services\Validations\TaskValidationService;
use Tests\TestCase;

class TaskValidationServiceTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIsActiveTaskWithoutExpirationTime(): void
    {
        $data = [
            'start_at' => (string) now(),
        ];

        $this->assertTrue(TaskValidationService::isTaskActive($data));
    }

    public function testIsActiveTaskWithoutRequiredStartTime(): void
    {
        $data = [
            'expired_at' => (string) now()->addYears(1),
        ];

        $this->assertFalse(TaskValidationService::isTaskActive($data));
    }
}
