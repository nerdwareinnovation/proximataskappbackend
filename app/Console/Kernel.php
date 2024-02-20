<?php

namespace App\Console;

use App\Console\Commands\CleanSoftDeletedFiles;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CleanSoftDeletedFiles::class,
];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('clean:soft-deleted-files')->daily(); // Run the command daily

    }
    protected function commands(): void
    {

        require base_path('routes/console.php');
    }
}
