@extends('layouts.app')

@section('title', 'The List of Tasks')
@section('content')
    <div>
        @forelse($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                    {{ $task->title }}
                </a>
            </div>
        @empty
            <div>There are NO tasks.</div>
        @endforelse
        @if ($tasks->count())
            {{ $tasks->links() }}
        @endif
    </div>
@endsection
