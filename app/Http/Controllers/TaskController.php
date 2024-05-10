<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('dashboard')->with('success', 'Task created successfully!');

}

public function view(Request $request)
{
    $tasks = Task::with('user')->get();
    return view('taskview', compact('tasks'));
}

public function delete(Request $request,$id)
{
    $task=Task::findorfail($id);
    $task->delete();
    return back();
}

public function update(Request $request,$id)
{
    $task = Task::findOrFail($id);
    $task->fill($request->except('id'))->save(); // Exclude 'id' field from update
    return back();
}

public function taskview()
{
    $user=Auth::id();
    $data=Task::where('assigned_to',$user)->get();
return view('userdashboard',compact('data'));
}


}