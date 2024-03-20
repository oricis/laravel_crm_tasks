<?php

namespace App\Modules\CrmTasks\Console\Commands;

use App\Models\User;
use App\Modules\CrmTasks\Models\Task;
use App\Modules\CrmTasks\Services\Actions\CreateUserTaskAction;
use App\Modules\CrmTasks\Services\Times\StartTimeCheckerService;
use App\Modules\CrmTasks\Services\Traits\PrepareUserTaskDataTrait;
use Illuminate\Console\Command;

class CrmSetTasksCommand extends Command
{
    use PrepareUserTaskDataTrait;


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
        $tasks = Task::query()
            ->where('start_at', '<=', (string) now())
            ->where('expired_at', '>=', (string) now())
            ->get();

        foreach ($tasks as $task) {
            try {
                $startTimeLabel = $task->startTime->label;
                if ((new StartTimeCheckerService($startTimeLabel))->pass()) {
                    foreach (User::get('id') as $user) {
                        $data = self::prepareUserTaskData($user->id, $task);

                        (new CreateUserTaskAction($data))
                            ->create();
                    }
                }
            } catch (\Exception $e) {
                error(getExceptionStr($e), 0, true);
            }
        }
    }
}
