<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Category::all();

    // === MY TASKS FILTER ===
    $myTasksQuery = Task::with('category')
        ->where('user_id', Auth::user()->id)
        ->where('completed', false);

    if ($request->filled('search_my_tasks')) {
        $myTasksQuery->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search_my_tasks . '%')
              ->orWhere('description', 'like', '%' . $request->search_my_tasks . '%');
        });
    }

    if ($request->filled('category_id_my')) {
        $myTasksQuery->where('category_id', $request->category_id_my);
    }

    $tasks = $myTasksQuery->get();

    // === AVAILABLE TASKS FILTER ===
    $availableTasksQuery = Task::with('category')
        ->where('user_id', '!=', Auth::user()->id)
        ->where('status', 'pending');

    if ($request->filled('search_available_tasks')) {
        $availableTasksQuery->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search_available_tasks . '%')
              ->orWhere('description', 'like', '%' . $request->search_available_tasks . '%');
        });
    }

    if ($request->filled('category_id_available')) {
        $availableTasksQuery->where('category_id', $request->category_id_available);
    }

    $otherTasks = $availableTasksQuery->get();

    return view('tasks.index', compact('tasks', 'otherTasks', 'categories'));
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
        $task = Task::find($id);
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if($task->update($request->all()))
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
        else
            return redirect()->route('tasks.index')->with('error', 'Task update failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if($task->delete())
            return redirect()->back()->with('success', 'Task deleted successfully');
        else
            return redirect()->back()->with('error', 'Task deletion failed');
    }

    public function accept(string $id)
    {
        $task = Task::find($id);
        $task->accepted_by_id = Auth::user()->id;
        $task->status = 'in_progress';
        if($task->save())
            return redirect()->route('tasks.index')->with('success', 'Task accepted successfully');
        else
            return redirect()->route('tasks.index')->with('error', 'Task accept failed');
    }

    public function markDone(string $id)
    {
        $task = Task::find($id);
        $task->status = 'completed';

        $notification = new Notification();
        $notification->sendNotification($task->user_id, "Your task $task->title has been marked as done");


        if($task->save())
            return redirect()->route('dashboard')->with('success', 'Your task has been marked as done.');
    }

}
