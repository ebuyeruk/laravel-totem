<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Facades\Route;
use Studio\Totem\Http\Controllers\Api\TasksController;

Route::group(['prefix' => 'totem'], function () {
    Route::get('tasks', [TasksController::class, 'index']);
});
