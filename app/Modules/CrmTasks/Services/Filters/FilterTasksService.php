<?php

declare(strict_types=1);

namespace App\Modules\CrmTasks\Services\Filters;

use App\Exceptions\InvalidDataException;
use App\Modules\CrmTasks\Services\Filters\FilterTasksService\FilterTasksContext;
use App\Modules\CrmTasks\Services\Traits\ServiceContextValidationTrait;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class FilterTasksService
{
    use ServiceContextValidationTrait;

    private bool $onlyOpen;
    private string $optionKey;


    public function __construct(string $optionKey, bool $onlyOpen = true)
    {
        $this->optionKey = $optionKey;
        $this->onlyOpen = $onlyOpen;
    }

    public function get(int $userId): EloquentCollection
    {
        try {
            $contextClass = FilterTasksContext::class;
            if (!self::isValidOptionKey($this->optionKey, $contextClass)) {
                $message = 'Invalid option key: ' . $this->optionKey;
                throw new InvalidDataException($message);
            }

            return (new FilterTasksContext($this->optionKey, $this->onlyOpen))
                ->get($userId);

        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return new EloquentCollection;
        }
    }
}
