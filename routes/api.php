<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

use Ebuyer\Totem\Http\Controllers\Api\ResultsController;
use Ebuyer\Totem\Http\Controllers\Api\Tasks\ExecuteTaskController;
use Ebuyer\Totem\Http\Controllers\Api\Tasks\TasksController;
use Ebuyer\Totem\Http\Controllers\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'totem', 'middleware' => ApiAuthMiddleware::class], function () {
    Route::get('tasks', [TasksController::class, 'index']);
    Route::post('tasks/{task_id}/execute', ExecuteTaskController::class)->name('totem.api.task.execute');
    Route::get('tasks/{task_id}', [TasksController::class, 'show']);
    Route::post('tasks/{task_id}', [TasksController::class, 'update'])->name('totem.api.task.update');

    Route::get('tasks/{task_id}/results', [ResultsController::class, 'index']);
    Route::get('tasks/{task_id}/results/{result_id}', [ResultsController::class, 'show']);
});
