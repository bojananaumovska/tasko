<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        Message::create([
            'message' => $request->message,
            'sender_id' => $request->sender_id,
            'reciever_id' => $request->reciever_id,
            'task_id' => $request->task_id
        ]);
        return redirect()->back();
    }

    public function getMessages(Task $task)
{
    $user = Auth::user();

    // Ensure user is related to the task
    // if ($task->user_id !== $user->id && $task->accepted_by_id !== $user->id) {
    //     abort(403);
    // }

    $messages = Message::where('task_id', $task->id)
                       ->orderBy('created_at', 'asc')
                       ->get();

    return response()->json($messages);
}
}
