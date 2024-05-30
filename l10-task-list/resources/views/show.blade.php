@extends('layouts.app')

@section('title', $task->title)
@section('content')
    <p> {{ $task->description }}</p>
    @if ($task->long_description)
        <p> {{ $task->long_description }}</p>
    @endif
    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>
    <p>{{ $task->complete ? 'Completed' : 'Not Completed' }}</p>
    <div>
        {{-- no need to specific $task->id as laravel known that it should select with prime key --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
    </div>
    <div>
        <form method="post" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('put')
            <button type="submit">Mark as {{ $task->complete ? 'not completed' : 'completed' }}</button>
        </form>
    </div>
    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit">delete</button>
        </form>
    </div>
@endsection
