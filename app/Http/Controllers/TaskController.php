<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        $otherTasks = Task::where('user_id', '!=', Auth::user()->id)->get();
        $categories = Category::all();
        return view('tasks.index', ['tasks' => $tasks, 'otherTasks' => $otherTasks, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       if(Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
            'due_date' => $request->due_date,
            'due_time' => $request->due_time,
            'location' => $request->location,
            'estimated_time' => $request->estimated_time,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]))
            return redirect()->route('tasks.index')->with('success', 'Task created successfully');
        else
            return redirect()->route('tasks.index')->with('error', 'Task creation failed');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
