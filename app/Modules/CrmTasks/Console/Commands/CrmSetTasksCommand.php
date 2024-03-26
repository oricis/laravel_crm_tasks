<?php

namespace App\Modules\CrmTasks\Console\Commands;

use App\Models\User;
use App\Modules\CrmTasks\Models\CrmTask;
use App\Modules\CrmTasks\Services\Actions\CreateCrmUserTaskAction;
use App\Modules\CrmTasks\Services\Times\CrmStartTimeCheckerService;
use App\Modules\CrmTasks\Services\Traits\PrepareCrmUserTaskDataTrait;
use Illuminate\Console\Command;

class CrmSetTasksCommand extends Command
{
    use PrepareCrmUserTaskDataTrait;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:set-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Try to assign tasks to the users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = CrmTask::query()
            ->where('start_at', '<=', (string) now())
            ->where('expired_at', '>=', (string) now())
            ->get();

        foreach ($tasks as $task) {
            try {
                $startTimeLabel = $task->startTime->label;
                if ((new CrmStartTimeCheckerService($startTimeLabel))->pass()) {
                    foreach (User::get('id') as $user) {
                        $data = self::prepareUserTaskData($user->id, $task);

                        (new CreateCrmUserTaskAction($data))
                            ->create();
                    }
                }
            } catch (\Exception $e) {
                error(getExceptionStr($e), 0, true);
            }
        }
    }
}
