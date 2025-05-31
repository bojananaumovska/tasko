<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public static function index(){
        $allTasks = Task::all();
        $allUsers = User::all();

        return view('basic.admin-pannel', compact('allTasks', 'allUsers'));
    }
}
