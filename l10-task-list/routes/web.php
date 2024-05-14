<?php

use \App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


Route::get('/welcome', function () {
  return view('welcome');
});

Route::get('/hello', function () {
  return view('hello', [
    'name' => 'Arin'
  ]);
});

// MARKME: Route for tasks
Route::get('/', function () {
  return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
  return view('index', ['tasks' => Task::latest()
    ->where('complete', true)
    ->get()]);
})->name('tasks.index');

// form view
Route::view('/tasks/create', 'create');

Route::get('/tasks/{id}', function ($id) {
  return view('show', [
    'task' => Task::findOrFail($id)
  ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
  // dd($request->all());
  $data = $request->validate([
    'title' => 'required|max:255',
    'description' => 'required',
    'long_description' => 'required'
  ]);
  $task = new Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();
  return redirect()->route('tasks.show', ['id' => $task->id]);
})->name('tasks.store');
