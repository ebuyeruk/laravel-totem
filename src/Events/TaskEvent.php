<?php

namespace Ebuyer\Totem\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Ebuyer\Totem\Task;

class TaskEvent extends Event
{
    use Dispatchable, SerializesModels;

    /**
     * @var Task
     */
    public Task $task;

    /**
     * Constructor.
     *
     * @param  Task  $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
