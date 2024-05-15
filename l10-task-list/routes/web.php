<?php

use \App\Models\Task;
use \App\Http\Requests\TaskRequest;
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
    // ->where('complete', true)
    ->get()]);
})->name('tasks.index');

// form view
Route::view('/tasks/create', 'create')
  ->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
  return view('edit', [
    'task' => $task
  ]);
})->name('tasks.edit');

// change from '/tasks/{id}', function ($id) no need to use id we can directly call task so that we don't have to use findOrFail
// if this model is not found it will automatically return 404
Route::get('/tasks/{task}', function (Task $task) {
  return view('show', [
    // by default laravel will assume that this task is the id which is the primary key
    // if we want to change it, go to Task.php and add a function like getRouteKeyName()
    'task' => $task
  ]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
  // $data = $request->validated();
  // $task = new Task;
  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->save();
  $task = Task::create($request->validated());
  return redirect()->route('tasks.show', ['task' => $task->id])
    // add session called success to create a flash msg -> will be display only once app.blade.php
    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
  // $data = $request->validated();
  // $task = new Task;
  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->save();
  $task->update($request->validated());
  return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task updated successfully!');
})->name('tasks.update');
