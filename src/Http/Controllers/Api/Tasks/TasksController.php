<?php

namespace Ebuyer\Totem\Http\Controllers\Api\Tasks;

use Dedoc\Scramble\Attributes\Group;
use Ebuyer\Totem\Contracts\TaskInterface;
use Ebuyer\Totem\Http\Requests\TaskUpdateRequest;
use Ebuyer\Totem\Http\Resources\TaskResource;

#[Group('Totem Tasks')]
class TasksController
{
    public function __construct(private TaskInterface $tasks)
    {
        //
    }

    /**
     * List all tasks.
     *
     * This endpoint lists all tasks and their status.
     */
    public function index()
    {
        return TaskResource::collection($this->tasks->findAll());
    }

    /**
     * Get a task
     *
     * Return a single task and all its info
     */
    public function show($task_id)
    {
        $task = $this->tasks->find($task_id);

        abort_if(! $task, 404);

        return TaskResource::make($task);
    }

    /**
     * Update task
     *
     * Update data on a task
     */
    public function update($task_id, TaskUpdateRequest $request)
    {
        $task = $this->tasks->find($task_id);

        return TaskResource::make($this->tasks->update(
            $request->validated(),
            $task
        ));
    }
}
