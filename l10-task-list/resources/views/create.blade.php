@extends('layouts.app')
@section('title', 'Add a Task')
@section('content')
    {{ $errors }}
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="15" rows="5"></textarea>
        </div>
        <div>
            <label for="long_desc">Long Description</label>
            <textarea name="long_description" id="long_desc" cols="15" rows="10"></textarea>
        </div>
        <button>Add task</button>
    </form>

@endsection
