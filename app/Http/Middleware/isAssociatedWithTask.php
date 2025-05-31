<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class isAssociatedWithTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $taskId = $request->route('id') ?? $request->route('task');
        $task = Task::findOrFail($taskId);

        if (!in_array(Auth::id(), [$task->client_id, $task->worker_id])) {
            abort(403, 'You are not authorized to access this task.');
        }

        return $next($request);
    }
}
