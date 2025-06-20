<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

use Ebuyer\Totem\Http\Controllers\Api\ResultsController;
use Ebuyer\Totem\Http\Controllers\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;
use Ebuyer\Totem\Http\Controllers\Api\TasksController;

Route::group(['prefix' => 'totem', 'middleware' => [ApiAuthMiddleware::class]], function () {
    Route::get('tasks', [TasksController::class, 'index']);
    Route::get('tasks/{task_id}', [TasksController::class, 'show']);
    Route::post('tasks/{task_id}', [TasksController::class, 'update']);

    Route::get('tasks/{task_id}/results', [ResultsController::class, 'index']);
    Route::get('tasks/{task_id}/results/{result_id}', [ResultsController::class, 'show']);
});
