<?php

namespace App\Console\Commands\VisitorCleanDatabase;

use App\Models\ShetabitVisit;
use Illuminate\Console\Command;

class VisitorCleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:visitor-clean-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // پاک کردن ویزیت هایی که از 3 ماه گذشته باشن
        $seconds = 3 * 30 * 24 * 3600;
        
        $time = now()->subSeconds($seconds);
        $visits = ShetabitVisit::where("created_at",'<', $time->toDateTime())->delete();
    }
}
