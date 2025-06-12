<?php

namespace Ebuyer\Totem\Http\Controllers;

use Ebuyer\Totem\Contracts\TaskInterface;
use Ebuyer\Totem\Task;

class ExecuteTasksController extends Controller
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $tasks;

    /**
     * @param  TaskInterface  $tasks
     */
    public function __construct(TaskInterface $tasks)
    {
        parent::__construct();

        $this->tasks = $tasks;
    }

    /**
     * Execute a specific task.
     *
     * @param  $task
     * @return \Illuminate\Http\Response
     */
    public function index($task)
    {
        $this->tasks->execute($task);

        return Task::find($task->id);
    }
}
