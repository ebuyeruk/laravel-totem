<?php

namespace Ebuyer\Totem\Tests\Feature;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Event;
use Ebuyer\Totem\Events\Executed;
use Ebuyer\Totem\Events\Executing;
use Ebuyer\Totem\Providers\ConsoleServiceProvider;
use Ebuyer\Totem\Result;
use Ebuyer\Totem\Task;
use Ebuyer\Totem\Tests\TestCase;

class TaskExecutionTest extends TestCase
{
    public function test_it_runs_a_scheduled_task()
    {
        $task = Task::factory()->create();

        Event::fake();

        $scheduler = $this->app->get(Schedule::class);
        $this->app->resolveProvider(ConsoleServiceProvider::class)
            ->schedule($scheduler);

        $scheduler->events()[0]
            ->run($this->app);

        $this->assertEquals(1, Result::count());

        $result = Result::first();
        $this->assertEquals($task->id, $result->task_id);

        Event::assertDispatched(Executing::class);
        Event::assertDispatched(Executed::class);
    }

    public function test_it_executes_a_scheduled_task()
    {
        $task = Task::factory()->create();

        Event::fake();

        $this->signIn()
            ->get(route('totem.task.execute', $task->id))
            ->assertSuccessful();

        $this->assertEquals(1, Result::count());

        $result = Result::first();
        $this->assertEquals($task->id, $result->task_id);

        Event::assertDispatched(Executed::class);
    }
}
