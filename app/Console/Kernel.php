<?php

namespace App\Console;

use App\Console\Commands\CheckPurchasingCommissions;
use App\Console\Commands\MarkCommissionsOverdue;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        MarkCommissionsOverdue::class,
        CheckPurchasingCommissions::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('commissions:markoverdue')->daily();
        $schedule->command('commissions:archive')->daily();
        $schedule->command('commissions:checkpurchasing')->everyThirtyMinutes();
        // Database backups
        if(config('app.env') == 'production') {
            $schedule->command('backup:run')->daily()
                ->runInBackground();
        } else {
            $schedule->command('backup:run')->weeklyOn(Schedule::SUNDAY)
                ->runInBackground();
        }
        $schedule->command('backup:clean')->weeklyOn(Schedule::MONDAY);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
