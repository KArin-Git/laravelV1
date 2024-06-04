@extends('layouts.app')

@section('title', 'The List of Tasks')
@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="link">Add Task</a>
    </nav>
    <div>
        @forelse($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->complete])>{{ $task->title }}
                </a>
            </div>
        @empty
            <div>There are NO tasks.</div>
        @endforelse
        @if ($tasks->count())
            <nav class="mt-4">
                {{ $tasks->links() }}
            </nav>
        @endif
    </div>
@endsection
