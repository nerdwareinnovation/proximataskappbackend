<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanSoftDeletedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:soft-deleted-files';
    protected $description = 'Delete soft-deleted files older than 7 days';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $task = Task::onlyTrashed()->get();
        foreach ($task as $tasks) {
            $deleted = $tasks->deleted_at;
//            dd($deleted);

            $delete = Carbon::now()->diffInDays(Carbon::createFromTimestamp($deleted->timestamp));
//            dd($delete);
            if ($delete > 7){
                $tasks->forceDelete();
                return response()->json("Permanently deleted soft-deleted file: $tasks->id");
            }

        }
    }
}
