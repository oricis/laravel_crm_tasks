<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\CrmTasks\Services\Validations;

use App\Modules\CrmTasks\Services\Validations\CrmTaskValidationService;
use Tests\TestCase;

class CrmTaskValidationServiceTest extends TestCase
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

        $this->assertTrue(CrmTaskValidationService::isTaskActive($data));
    }

    public function testIsActiveTaskWithoutRequiredStartTime(): void
    {
        $data = [
            'expired_at' => (string) now()->addYears(1),
        ];

        $this->assertFalse(CrmTaskValidationService::isTaskActive($data));
    }
}
