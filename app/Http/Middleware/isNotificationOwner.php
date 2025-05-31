<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class isNotificationOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $notification = Notification::findOrFail($request->route('id'));

        if ($notification->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this notification.');
        }

        return $next($request);
    }
}
