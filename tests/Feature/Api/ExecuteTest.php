<?php

use Ebuyer\Totem\Result;
use Ebuyer\Totem\Task;

use function Pest\Laravel\post;

it('runs a scheduled task', function () {
    $task = Task::factory()->create();

    expect(Result::count())
        ->toEqual(0);

    post(route('totem.api.task.execute', $task->id))
        ->assertSuccessful();

    expect(Result::count())
        ->toEqual(1)
        ->and(Result::first()->task_id)
        ->toEqual($task->id);
});

it('returns 404 when task not found', function () {
    post(route('totem.api.task.execute', 1))
        ->assertNotFound();
});
