<?php

namespace Ebuyer\Totem\Http\Controllers\Api;

use Dedoc\Scramble\Attributes\Group;
use Ebuyer\Totem\Http\Requests\TaskRequest;
use Ebuyer\Totem\Http\Requests\TaskUpdateRequest;
use Ebuyer\Totem\Http\Resources\TaskResource;

class TasksController
{
    /**
     * List all tasks.
     *
     * This endpoint lists all tasks and their status.
     */
    public function index()
    {
        return TaskResource::collection(app('totem.tasks')->findAllActive());
    }

    /**
     * Get a task
     *
     * Return a single task and all its info
     */
    public function show($task_id)
    {
        return TaskResource::make(
            app('totem.tasks')->find($task_id)
        );
    }

    public function update($task_id, TaskUpdateRequest $request)
    {
        return [
            'task_id' => $task_id,
            'is_active' => $request->validated('is_active'),
        ];
    }
}
