@extends('layouts.app')

@section('title', 'List of tasks')

@section('content')
<div class="">

    <nav class="mb-4"><a href="{{ route('tasks.create') }}" class="link">Add Task!</a></nav>

    {{-- @if(count($tasks))
        @foreach ($tasks as $task)
            <div class="">{{$task->title}}</div>
        @endforeach
    @else
        <div class="">There are no tasks</div>
    @endif --}}

    @forelse ($tasks as $task)
        <div class="">
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through truncate' => $task->completed])>{{$task->title}}</a>
        </div>
    @empty
        <div class="">There are no tasks</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">{{ $tasks->links() }}</nav>
    @endif

</div>

@endsection