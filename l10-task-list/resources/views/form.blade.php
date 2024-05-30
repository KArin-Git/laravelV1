@extends('layouts.app')
@section('title', 'Add a Task')
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
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div>
            <label for="title">Title</label>
            {{-- old helper work with form method"POST" only NOT PROOFING show the value that store in session --}}
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="15" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_desc">Long Description</label>
            <textarea name="long_description" id="long_desc" cols="15" rows="10">{{ old('long_description') }}</textarea>
            @error('long_description')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>
        <button>Add task</button>
    </form>

@endsection
