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
        //$schedule->command('app:milgerd-ajdar-alborz-gharb')->everyMinute();

        // سایت مپ
        $schedule->command('app:site-map-pages')->daily();
        $schedule->command('app:site-map-products')->daily();
        $schedule->command('app:site-map-blog-posts')->daily();
        $schedule->command('app:site-map-categories')->daily();
        $schedule->command('app:site-map-vendors')->daily();
        $schedule->command('app:site-map-merchants')->daily();
        $schedule->command('app:site-map-retailer')->daily();
        $schedule->command('app:site-map-customs')->daily();
        $schedule->command('app:site-map-freightage')->daily();
        $schedule->command('app:site-map-driver')->daily();

        // پاک کردن ویزیت هایی که سه ماه گذشته باشن
        $schedule->command('app:visitor-clean-database')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
