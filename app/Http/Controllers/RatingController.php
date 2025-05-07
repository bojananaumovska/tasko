<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rating;
use App\Models\Task;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->completed = true;
        $task->save();
        if(Rating::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'rated_user_id' => $request->rated_user_id,
            'rater_user_id' => $request->rater_user_id,
            'task_id' => $request->task_id
        ]))
            return redirect()->route('tasks.index')->with('success', 'Rating created successfully');
        else
            return redirect()->route('tasks.index')->with('error', 'Rating creation failed');
    }
}
