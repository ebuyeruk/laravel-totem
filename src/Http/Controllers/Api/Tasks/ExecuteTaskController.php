<?php

namespace Ebuyer\Totem\Http\Controllers\Api\Tasks;

use Dedoc\Scramble\Attributes\Group;
use Ebuyer\Totem\Contracts\TaskInterface;
use Ebuyer\Totem\Http\Resources\ResultResource;

#[Group('Totem Tasks')]
class ExecuteTaskController
{
    public function __construct(private TaskInterface $tasks)
    {
        //
    }

    /**
     * Execute Task
     */
    public function __invoke($task)
    {
        $task = $this->tasks->execute($task);

        return ResultResource::make($task->last_result)
            ->show_result(true);
    }
}
