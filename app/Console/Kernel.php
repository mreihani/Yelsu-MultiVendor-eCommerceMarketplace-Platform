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

        // به روز رسانی ایندکس محصولات و کاربران الاستیک سرچ
        $schedule->command('app:update-elastic-search-index')->everyTenMinutes();

        // به روز رسانی تعداد بازدید های پلتفرم برای نمایش نمودار
        $schedule->command('app:update-visitors-chart-ww')->dailyAt('3:00');
        $schedule->command('app:update-visitors-chart-iran')->dailyAt('3:00');
        $schedule->command('app:update-visitors-chart-unique-ww')->dailyAt('3:00');
        $schedule->command('app:update-visitors-chart-unique-iran')->dailyAt('3:00');

        // Remove expired sms tokens
        $schedule->command('app:clear-expired-sms-tokes')->daily();
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
