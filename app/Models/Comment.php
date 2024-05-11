<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    
    public function getComments($taskId) {
        $comments = Comment::where('task_id', $taskId)
                           ->with('user:id,name') 
                           ->get(['id', 'content', 'user_id', 'created_at']); 
        return response()->json(['comments' => $comments]);
    }
    
}
