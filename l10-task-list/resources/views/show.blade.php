@extends('layouts.app')

@section('title', $task->title)
@section('content')
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="link">Go back to the task list</a>
    </div>
    <p class="mb-4 text-slate-700"> {{ $task->description }}</p>
    @if ($task->long_description)
        <p lass="mb-4 text-slate-700"> {{ $task->long_description }}</p>
    @endif
    <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} . Updated
        {{ $task->updated_at->diffForHumans() }}</p>
    <p class="mb-4">
        @if ($task->complete)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not Completed</span>
        @endif
    <div class="flex gap-2">
        {{-- no need to specific $task->id as laravel known that it should select with prime key --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="btn">Edit</a>

        <form method="post" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('put')
            <button type="submit" class="btn">Mark as {{ $task->complete ? 'not completed' : 'completed' }}</button>
        </form>

        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn">delete</button>
        </form>
    </div>
@endsection
