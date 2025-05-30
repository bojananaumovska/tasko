<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rating;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Exception;


class RatingController extends Controller
{
    public function store(Request $request)
    {   DB::beginTransaction();

        try{
        $task = Task::find($request->task_id);
        $task->completed = true;
        $task->save();
        
        Rating::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'rated_user_id' => $request->rated_user_id,
            'rater_user_id' => $request->rater_user_id,
            'task_id' => $request->task_id
        ]);
        $notification = new Notification();
        $notification->sendNotification($request->rated_user_id, "Your have new rating for task $task->title");
        DB::commit();

        return redirect()->route('tasks.index')->with('success', 'Rating created successfully');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('tasks.index')->with('error', 'Rating creation failed');

        }
    }
}
