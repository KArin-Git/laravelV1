@extends('layouts.app')
@section('title', isset($task) ? 'Edit' : 'Add a Task')
@section('content')
    {{-- {{ $errors }} --}}
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('put')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            {{-- value="{{ old('title') }}" old helper work with form method"POST" only NOT PROOFING show the value that store in session --}}
            <input type="text" name="title" id="title" @class(['border-red-500' => $errors->has('title')])
                value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="desc">Description</label>
            <textarea name="description" id="desc" @class(['border-red-500' => $errors->has('description')]) cols="15" rows="5">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_desc">Long Description</label>
            <textarea name="long_description" id="long_desc" @class(['border-red-500' => $errors->has('long_description')]) cols="15" rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-2 items-center">
            <button type="submit" class="btn">
                @isset($task)
                    Update task
                @else
                    Add task
                @endisset
            </button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        </div>
    </form>

@endsection
