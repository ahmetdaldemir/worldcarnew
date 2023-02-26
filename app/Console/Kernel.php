<?php

namespace App\Console;

use App\Console\Commands\CampingJobs;
use App\Console\Commands\Currency;
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
        CampingJobs::class,
        Currency::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('cron:currency')->dailyAt('10:11');
        $schedule->command('sitemap:generate')->daily();
        $schedule->command('cnn:finance')->dailyAt('10:10');
        $schedule->command('logs:clear')->daily();
        $schedule->command('birthday:cron')->dailyAt('00:01');
        $schedule->command('telescope:prune')->daily();
        $schedule->command('server-monitor:run-checks')->withoutOverlapping()->everyMinute();

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
