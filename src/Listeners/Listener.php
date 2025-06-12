<?php

namespace Ebuyer\Totem\Listeners;

use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ebuyer\Totem\Contracts\TaskInterface;

class Listener implements ShouldQueue
{
    /**
     * @var TaskInterface.
     */
    protected TaskInterface $tasks;

    /**
     * @var Container
     */
    protected Container $app;

    /**
     * Create the event listener.
     *
     * @param  Container  $app
     * @param  TaskInterface  $tasks
     */
    public function __construct(Container $app, TaskInterface $tasks)
    {
        $this->tasks = $tasks;
        $this->app = $app;
    }
}
