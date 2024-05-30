@extends('layouts.app')
@section('title', isset($task) ? 'Edit' : 'Add a Task')
@section('styles')
    <style>
        .error-msg {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection
@section('content')
    {{-- {{ $errors }} --}}
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('put')
        @endisset
        <div>
            <label for="title">Title</label>
            {{-- value="{{ old('title') }}" old helper work with form method"POST" only NOT PROOFING show the value that store in session --}}
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="15" rows="5">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_desc">Long Description</label>
            <textarea name="long_description" id="long_desc" cols="15" rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">
            @isset($task)
                Update task
            @else
                Add task
            @endisset
        </button>
    </form>

@endsection
