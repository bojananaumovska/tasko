<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Message;
use App\Models\Rating;

class UserController extends Controller
{
    public function show(String $id)
    {
        $user = User::find($id);
        $ratings = $user->ratingsReceived;
        

        $average_rating = 0;
        $rating_count = 0;
        foreach ($ratings as $rating) {
            $average_rating += $rating->rating;
            $rating_count++;
        }
        if ($rating_count > 0) {
            $average_rating = $average_rating / $rating_count;
        }else{
            $average_rating = 'No ratings yet';
        }
        
        return view('users.user', compact('user', 'ratings', 'average_rating'));
    }

    public function dashboard(string $task_id='0')
    {
        $user = Auth::user();

        $ratings = $user->ratingsReceived;

        $average_rating = 0;
        $rating_count = 0;
        foreach ($ratings as $rating) {
            $average_rating += $rating->rating;
            $rating_count++;
        }
        if ($rating_count > 0) {
            $average_rating = $average_rating / $rating_count;
        }else {
            $average_rating = 'No ratings yet';
        }
        

        // Твоите активни задачи (како креирани од корисникот, но не завршени)
        $activeTasks = Task::where('user_id', $user->id)
                           ->where('status', 'in_progress')
                           ->get();
    
        // Задачи што корисникот ги прифатил
        $acceptedTasks = Task::where('accepted_by_id', $user->id)
                             ->where('status', 'in_progress')
                             ->get();

        $completedTasksAsProvider = Task::where('accepted_by_id', $user->id)
                             ->where('status', 'completed')
                             ->get();

        $completedTasksAsClient = Task::where('user_id', $user->id)
                             ->where('status', 'completed') 
                             ->get();
        
        return view('basic.dashboard', compact('activeTasks', 'acceptedTasks', 'completedTasksAsProvider', 'completedTasksAsClient', 'ratings','average_rating'));
    }


}
