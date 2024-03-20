<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('crm:set-tasks')
            ->environments(['production', 'test'])
            ->daily()
            ->at('00:00')
            ->evenInMaintenanceMode()
            ->onFailure(function () {
                error('>> Failing attempt to assign user tasks', 0, true);
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load([
            __DIR__.'/Commands',
            app_path('Modules/CrmTasks/Console/Commands'),
        ]);

        require base_path('routes/console.php');
    }
}
