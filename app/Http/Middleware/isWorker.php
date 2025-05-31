<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class isWorker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $task = Task::findOrFail($request->route('id'));

        if ($task->worker_id !== Auth::id()) {
            abort(403, 'Only assigned worker can mark task as done.');
        }

        return $next($request);
    }
}
