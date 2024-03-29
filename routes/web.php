<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Task;
use \App\Http\Requests\TaskRequest;

Route::get('/', function () { 
    return redirect()->route('tasks.index');
 });

Route::get('/tasks', function () {
    return view('index', ['tasks' => Task::latest()->paginate(10)]);
}) -> name('tasks.index');

Route::view('/tasks/create', 'create') -> name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task)  {
    return view('edit', ['task' => $task]);
}) -> name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task)  {
    return view('show', ['task' => $task]);
}) -> name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
  // dd($request -> all());
  // $data = $request->validate([
  //   'title' => 'required|max:255',
  //   'description' => 'required',
  //   'long_description' => 'required',
  // ]);
  
  // $data = $request -> validated();

  // $task = new Task;
  // $task->title = $data["title"];
  // $task->description = $data["description"];
  // $task->long_description = $data["long_description"];
  // $task->save();

  $task = Task::create($request->validated());

  return redirect() -> route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully!');

}) -> name('tasks.store');

Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
  // $data = $request->validate([
  //   'title' => 'required|max:255',
  //   'description' => 'required',
  //   'long_description' => 'required',
  // ]);

  // $task = Task::findOrFail($id);

  // $data = $request -> validated();

  // $task->title = $data["title"];
  // $task->description = $data["description"];
  // $task->long_description = $data["long_description"];
  // $task->save();

  $task->update($request->validated()); // because already existed model

  return redirect() -> route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully!');

}) -> name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
  $task->delete();
  return redirect() -> route('tasks.index')->with('success', 'Task deleted successfully!');
}) -> name('tasks.destroy');


Route::put('task/{task}/toggle-complete', function (Task $task) {
  // $task->completed = !$task->completed;
  // $task->save();

  $task->toggleComplete();

  return redirect()->back()->with('success', 'Task updated successfully');
}) -> name('tasks.toggle-complete');


// Route::get("/lll", function () {
//     return "hello";
// })-> name('helloRoute');

// Route::get("/hallo", function () {
//     return redirect() -> route('helloRoute');
// });

// Route::get("/greet/{name}", function ($name) {
//     return "Hello " . $name . '!';
// });

// Route::fallback(function () {
//     return "still got here";
// });