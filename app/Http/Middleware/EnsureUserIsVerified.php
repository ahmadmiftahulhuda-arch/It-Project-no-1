<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and if they are not verified.
        if (Auth::check() && !Auth::user()->verified) {
            // Redirect them back to the previous page with an error message.
            return redirect()->back()
                             ->with('error', '⚠️ Akun Anda harus diverifikasi oleh admin untuk mengakses halaman ini. Mohon hubungi administrator.');
        }

        return $next($request);
    }
}