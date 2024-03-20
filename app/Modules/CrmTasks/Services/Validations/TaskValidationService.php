<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Validations;

use App\Exceptions\InvalidDataException;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Repositories\Data\Data;
use App\Modules\CrmTasks\Services\Times\TimestampsService;

class TaskValidationService
{

    public static function isTaskActive(Task|array $task): bool
    {
        $strNow = (string) now();
        $data = (is_array($task))
            ? $task
            : [
                'expired_at' => $task->expired_at,
                'start_at'   => $task->start_at,
            ];

        // without expiration time
        if (! isset($data['expired_at'])) {
            $data['expired_at'] = Data::MAX_MYSQL_TIMESTAMP;
        }

        try {
            if (!isset($data['start_at'])
            || !TimestampsService::isValidTimestampString($data['start_at'])) {
                $message = 'Invalid timestamp to start the task';
                throw new InvalidDataException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return false;
        }

        return $data['expired_at'] >= $strNow
            || $data['start_at'] <= $strNow;
    }
}


