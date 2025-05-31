<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsUserSelfOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->route('id');

        if (Auth::id() != $userId && !Auth::user()?->is_admin) {
            abort(403, 'Not authorized to perform this action.');
        }

        return $next($request);
    }
}
