<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // If the user is not authenticated,
            // the 'auth' middleware will handle the redirection to the login page.
            return $next($request);
        }

        $user = Auth::user();

        // If the user's role is in the list of allowed roles, let them proceed.
        if (isset($user->peran) && in_array($user->peran, $roles)) {
            return $next($request);
        }

        // If the user's role is not in the allowed list, redirect them.
        // Admins trying to access user pages are sent to the admin dashboard.
        if (isset($user->peran) && $user->peran === 'Administrator') {
            return redirect()->route('admin.dashboard');
        }

        // Users (non-admins) trying to access admin pages are sent to the home page.
        return redirect()->route('home');
    }
}