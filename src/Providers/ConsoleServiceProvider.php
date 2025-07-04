<?php

namespace Ebuyer\Totem\Providers;

use Ebuyer\Totem\Jobs\ExecuteTaskJob;
use Ebuyer\Totem\ResultStatus;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Ebuyer\Totem\Events\Executed;
use Ebuyer\Totem\Events\Executing;
use Ebuyer\Totem\Totem;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register any services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(Schedule::class, function ($schedule) {
            if (Totem::isEnabled()) {
                $this->schedule($schedule);
            }
        });
    }

    /**
     * Prepare schedule from tasks.
     *
     * @param  Schedule  $schedule
     */
    public function schedule(Schedule $schedule)
    {
        $tasks = app('totem.tasks')->findAllActive();

        $tasks->each(function ($task) use ($schedule) {
            $event = $schedule->call(function () use ($task) {
                $result = $task->results()->create([
                    'ran_at' => now(),
                    'duration' => 0,
                    'result' => ResultStatus::QUEUED,
                ]);
                ExecuteTaskJob::dispatch($task, $result);
            });

            $event->cron($task->getCronExpression())
                ->name($task->description)
                ->timezone($task->timezone)
                ;
            if ($task->dont_overlap) {
                $event->withoutOverlapping();
            }
            if ($task->run_in_maintenance) {
                $event->evenInMaintenanceMode();
            }
            if ($task->run_on_one_server && in_array(config('cache.default'), ['memcached', 'redis', 'database', 'dynamodb'])) {
                $event->onOneServer();
            }
            if ($task->run_in_background) {
                $event->runInBackground();
            }
        });
    }
}
