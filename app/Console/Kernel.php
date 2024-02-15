<?php

namespace App\Console;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('clean:soft-deleted-files')->daily(); // Run the command daily

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        
        require base_path('routes/console.php');
    }
}
