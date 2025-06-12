<?php

namespace Studio\Totem\Http\Controllers\Api;

use Dedoc\Scramble\Attributes\Group;
use Studio\Totem\Http\Requests\TaskRequest;
use Studio\Totem\Http\Requests\TaskUpdateRequest;

class TasksController
{
    /**
     * List all tasks.
     *
     * This endpoint lists all tasks and their status.
     */
    public function index()
    {
        return [
            'tasks' => []
        ];
    }

    /**
     * Get a task
     *
     * Return a single task and all its info
     */
    public function show($task_id)
    {
        return [
            'task_id' => $task_id
        ];
    }

    public function update($task_id, TaskUpdateRequest $request)
    {
        return [
            'task_id' => $task_id,
            'is_active' => $request->validated('is_active'),
        ];
    }
}
