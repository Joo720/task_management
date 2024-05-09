<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
public function show(Request $request)
{
$user=User::all();
return view('dashboard',compact('user'));
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'assigned_to' => 'required|exists:users,id', 
        'status' => 'nullable|in:open,progress,done',
        'file' => 'nullable|file|max:10240', 
     ]);

    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('uploads');
    } else {
        $path = null;
    }

    $task = new Task();
    $task->title = $validatedData['title'];
    $task->description = $validatedData['description'];
    $task->assigned_to = $validatedData['assigned_to'];
    $task->status = $validatedData['status'];
    $task->file_path = $path; 
    $task->save();
    return redirect()->route('tasks.view')->with('success', 'Task created successfully!');

}

public function view(Request $request)
{
    $tasks=Task::all();
    return view('taskview');
}

}
