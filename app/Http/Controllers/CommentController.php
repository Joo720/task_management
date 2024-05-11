<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads');
        } else {
            $path = null;
        }

        $comment = new Comment();
        $comment->user()->associate($user); 
        $comment->task()->associate($task); 
        $comment->content = $request->content;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public'); // Specify 'public' disk
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

        public function usershow(Request $request)
        {
            $comments = Comment::with(['user', 'task'])
                        ->where('user_id', Auth::id())
                        ->get();
        return view('usercomments', compact('comments'));
        }

        public function getComments($taskId)
        {
            $comments = Comment::where('task_id', $taskId)
                               ->with(['user:id,name']) 
                               ->get(['id', 'content', 'user_id', 'created_at']); 
            
            // Iterate through comments and add the user_name to each comment
            foreach ($comments as $comment) {
                $comment->user_name = User::find($comment->user_id)->name;
            }
    
            return response()->json(['comments' => $comments]);
        }
}
