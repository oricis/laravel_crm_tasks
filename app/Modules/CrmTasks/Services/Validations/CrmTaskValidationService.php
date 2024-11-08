<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Validations;

use App\Exceptions\InvalidDataException;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Repositories\Data\CrmData;
use App\Modules\CrmTasks\Services\Times\CrmTimestampsService;

class CrmTaskValidationService
{

    public static function isTaskActive(CrmTask|array $task): bool
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
            $data['expired_at'] = CrmData::MAX_MYSQL_TIMESTAMP;
        }

        try {
            if (!isset($data['start_at'])
            || !CrmTimestampsService::isValidTimestampString($data['start_at'])) {
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


