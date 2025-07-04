<?php

use Ebuyer\Totem\Task;
use function Pest\Laravel\post;

it('Can update a task', function ($field, $initial, $update) {
    $this->withoutExceptionHandling();
    $task = Task::factory()->create([$field => $initial]);

    expect($task->$field)
        ->toBe($initial);

    post(route('totem.api.task.update', $task->id), [
        $field => $update,
    ])->assertSuccessful();

    $task->refresh();

    expect($task->$field)
        ->toBe($update);
})->with([
    ['is_active', false, true],
    ['description', 'test', 'testing'],
    ['expression', '*/1 * * * *', '*/5 * * * *']
]);

it('returns 4xx if input invalid', function ($field, $update) {
    $task = Task::factory()->create();
    post(route('totem.api.task.update', $task->id), [
        $field => $update,
    ])->assertInvalid();
})->with([
    ['is_active', 'true'],
    ['expression', '*/1 * * * * *']
]);

it('returns not found if task does no exist', function () {
    post(route('totem.api.task.update', 1))
        ->assertNotFound();
});
