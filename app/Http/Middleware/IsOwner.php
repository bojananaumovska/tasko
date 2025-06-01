<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $taskId = $request->route('id'); 
        $task = Task::findOrFail($taskId);

        if (Auth::id() !== $task->user_id and Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
