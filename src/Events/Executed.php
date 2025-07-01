<?php

namespace Ebuyer\Totem\Events;

use Ebuyer\Totem\Notifications\TaskCompleted;
use Ebuyer\Totem\Task;

class Executed extends BroadcastingEvent
{
    public float $start;
    public string $output;

    /**
     * Executed constructor.
     *
     * @param  Task  $task
     * @param  string|float|int  $started
     * @param  $output
     */
    public function __construct(Task $task, $started, $output)
    {
        parent::__construct($task);

        $this->start = $started;
        $this->output = $output;

        $task->notify(new TaskCompleted($output));
        $task->autoCleanup();
    }
}
