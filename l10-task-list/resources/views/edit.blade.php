@extends('layouts.app')
@section('title', 'Edit a Task')
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
    <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}">
        @csrf
        {{-- directive method bc http don't have put >> spoofing --}}
        @method('PUT')
        <div>
            <label for="title">Title</label>
            {{--  add value="{{ $task->title }}" to called old value --}}
            <input type="text" name="title" id="title" value="{{ $task->title }}">
            @error('title')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="15" rows="5">{{ $task->description }}</textarea>
            @error('description')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_desc">Long Description</label>
            <textarea name="long_description" id="long_desc" cols="15" rows="10">{{ $task->long_description }}</textarea>
            @error('long_description')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <button>Add task</button>
    </form>

@endsection
