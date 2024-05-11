<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240', 
        ]);

        
        $user = auth()->user();

      
        $task = Task::findOrFail($id);

        $comment = new Comment();
        $comment->user()->associate($user); 
        $comment->task()->associate($task); 
        $comment->content = $request->content;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName); 
            $comment->file_path = $filePath;
        }

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    public function show(Request $request)
    {
        $comments = Comment::with(['user', 'task'])->get();
        return view('comments', compact('comments'));
    }
}
