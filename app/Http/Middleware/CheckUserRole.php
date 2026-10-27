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

        // 1. Cek peran kolom database bawaan PINTER
        if (isset($user->peran) && in_array($user->peran, $roles)) {
            return $next($request);
        }

        // 2. Cek role Spatie Permission jika terpasang
        if (method_exists($user, 'hasAnyRole')) {
            try {
                if ($user->hasAnyRole($roles)) {
                    return $next($request);
                }
            } catch (\Throwable $e) {
                // Lewati jika role belum terdaftar
            }
        }

        // Admins trying to access user pages are sent to the admin dashboard.
        $isAdmin = (isset($user->peran) && in_array($user->peran, ['Administrator', 'Admin'])) ||
                   (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(['Administrator', 'Admin', 'Superadmin']));

        if ($isAdmin) {
            return redirect()->route('admin.dashboard');
        }

        // Users (non-admins) trying to access admin pages are sent to the home page.
        return redirect()->route('home');
    }
}