<?php

namespace Ebuyer\Totem\Http\Controllers\Api;

use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\QueryParameter;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Ebuyer\Totem\Http\Resources\ResultResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

#[Group('Totem Results')]
class ResultsController
{
    /**
     * Get Results
     *
     * Get a paginated list of results for a task
     * @authenticated SecurityScheme::apiKey('query', 'api_token');
     * @response AnonymousResourceCollection<LengthAwarePaginator<ResultResource>>
     */
    #[QueryParameter('per_page', description: 'Number of items per page.', type: 'int', default: 15, example: 20)]
    #[QueryParameter('page', description: 'Number of current page.', type: 'int', default: 1, example: 20)]
    #[QueryParameter('result', description: 'Show result parameter for each result', type: 'int', default: 0, example: 1)]
    public function index($task_id, Request $request)
    {
        $task = app('totem.tasks')->find($task_id);

        abort_if(!$task, 404);

        return ResultResource::collection($task->results()->paginate($request->input('per_page', 15)));
    }

    /**
     * Get Result
     *
     * Get a result and its output
     */
    public function show($task_id, $result_id)
    {
        $task = app('totem.tasks')->find($task_id);
        abort_if(! $task, 404);
        $result = $task->results()->find($result_id);
        abort_if(! $result, 404);

        return ResultResource::make($result)->show_result(true);
    }
}
