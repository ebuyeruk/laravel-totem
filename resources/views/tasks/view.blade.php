@extends('totem::layout')
@section('page-title')
    @parent
    - Task
@stop
@section('title')
    <div class="uk-flex uk-flex-between uk-flex-middle">
        <h5 class="uk-card-title uk-margin-remove">Task Details</h5>
        <status-button :data-task="{{ $task }}" :data-exists="{{ $task->exists ? 'true' : 'false' }}" activate-url="{{route('totem.task.activate')}}" deactivate-url="{{route('totem.task.deactivate', $task)}}"></status-button>
    </div>
@stop
@section('main-panel-content')
    <ul class="uk-list uk-list-striped">
        <li>
            <span class="uk-text-muted">Name</span>
            <span class="">{{Str::limit($task->name, 80)}}</span>
        </li>
        <li>
            <span class="uk-text-muted">Description</span>
            <span class="">{!! Str::markdown($task->description) !!}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Command</span>
            <span class="">{{$task->command}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Parameters</span>
            <span class="">{{$task->parameters ?? "N/A"}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Cron Expression</span>
            <span class="">
                <span>{{$task->getCronExpression()}}</span>
            </span>
        </li>
        <li>
            <span class="uk-text-muted ">Timezone</span>
            <span class="">{{$task->timezone}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Created At</span>
            <span class="">{{$task->created_at->toDateTimeString()}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Updated At</span>
            <span class="">{{$task->updated_at->toDateTimeString()}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Email Notification</span>
            <span class="">{{$task->notification_email_address ?? 'N/A'}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">SMS Notification</span>
            <span class="">{{$task->notification_phone_number ?? 'N/A'}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Slack Notification</span>
            <span class="">{{$task->notification_slack_webhook ?? 'N/A'}}</span>
        </li>
        <li>
            <span class="uk-text-muted ">Average Run Time</span>
            <span class="">{{$task->results()->count() > 0 ? number_format(  $task->results()->sum('duration') / (1000 * $task->results()->count()) , 2) : '0'}} seconds</span>
        </li>
        <li>
            <span class="uk-text-muted ">Next Run Schedule</span>
            <span class="">{{$task->upcoming }}</span>
        </li>
        @if($task->dont_overlap)
            <li>
                <span class="">Doesn't Overlap with another instance of this task</span>
            </li>
        @endif
        @if($task->run_in_maintenance)
            <li>
                <span class="">Runs in maintenance mode</span>
            </li>
        @endif
        @if($task->run_on_one_server)
            <li>
                <span class="">Runs on a single server</span>
            </li>
        @endif
        @if($task->run_in_background)
            <li>
                <span class="">Runs in the background</span>
            </li>
        @endif
    </ul>
@stop
@section('main-panel-footer')
    <div class="uk-flex uk-flex-between uk-flex-middle">
        <span>
            <a href="{{ route('totem.task.edit', $task) }}" class="uk-button uk-button-primary uk-button-small">Edit</a>
            <form class="uk-display-inline" action="{{route('totem.task.delete', $task)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="uk-button uk-button-danger uk-button-small">Delete</button>
            </form>
            <a href="{{ route('totem.tasks.all') }}" class="uk-button uk-button-secondary uk-button-small">Cancel</a>
        </span>
        <execute-button :data-task="{{ $task }}" url="{{route('totem.task.execute', $task)}}" button-class="uk-button-small uk-button-primary"></execute-button>
    </div>
@stop
@section('additional-panels')
    <div class="uk-card uk-card-default uk-margin-top">
        <div class="uk-card-header">
            <h5 class="uk-card-title uk-margin-remove">Execution Results</h5>
        </div>
        <div class="uk-card-body uk-padding-remove-top">
            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>Executed At</th>
                        <th>Duration</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($results = $task->results()->orderByDesc('created_at')->paginate(10) as $result)
                    <tr>
                        <td>{{$result->ran_at->toDateTimeString()}}</td>
                        <td>{{ number_format($result->duration / 1000 , 2)}} seconds</td>
                        <td>
                            <task-output output="{{nl2br($result->result)}}"></task-output>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="uk-text-center" colspan="5">
                            <p>Not executed yet.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="uk-card-footer">
            {{$results->links('totem::partials.pagination')}}
        </div>
    </div>
@stop
