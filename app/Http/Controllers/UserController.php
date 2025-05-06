<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class UserController extends Controller
{
    public function show(String $id)
    {
        $user = User::find($id);
        return view('users.user');
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Твоите активни задачи (како креирани од корисникот, но не завршени)
        $activeTasks = Task::where('user_id', $user->id)
                           ->where('status', 'in_progress')
                           ->get();
    
        // Задачи што корисникот ги прифатил
        $acceptedTasks = Task::where('accepted_by_id', $user->id)
                             ->where('status', 'in_progress')
                             ->get();
    
        return view('basic.dashboard', compact('activeTasks', 'acceptedTasks'));
    }
}
