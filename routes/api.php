<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Facades\Route;
use Ebuyer\Totem\Http\Controllers\Api\TasksController;

Route::group(['prefix' => 'totem'], function () {
    Route::get('tasks', [TasksController::class, 'index']);
    Route::get('tasks/{task_id}', [TasksController::class, 'show']);
    Route::post('tasks/{task_id}', [TasksController::class, 'update']);
});
