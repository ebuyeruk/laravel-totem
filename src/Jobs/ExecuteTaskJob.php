<?php

namespace Ebuyer\Totem\Jobs;

use Ebuyer\Totem\Console\DatabaseOutput;
use Ebuyer\Totem\Result;
use Ebuyer\Totem\ResultStatus;
use Ebuyer\Totem\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class ExecuteTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Task
     */
    protected Task $task;

    /**
     * @var Result
     */
    protected Result $result;

    /**
     * Create a new job instance.
     *
     * @param  Task  $task
     * @param  Result  $result
     * @return void
     */
    public function __construct(Task $task, Result $result)
    {
        $this->task = $task;
        $this->result = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start = microtime(true);

        try {
            $exit = Artisan::call($this->task->command, $this->task->compileParameters(), new DatabaseOutput($this->result, $start));
        } catch (\Exception $e) {
            $this->result->result .= $e->getMessage();
        }

        $this->result->status = ($exit ?? 1) == 0 ? ResultStatus::SUCCESS : ResultStatus::FAILED;
        $this->result->duration = (microtime(true) - $start) * 1000;
        $this->result->save();
    }
}
