<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ensure2FAIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is logged in, has 2FA enabled, and is in the process of verifying 2FA
        if ($user && $user->two_factor_enabled && $request->session()->get('2fa_in_progress')) {
            
            // If the user is trying to access any page other than the 2FA verification page,
            // redirect them back to the verification page.
            if (!$request->routeIs('admin.2fa.verify')) {
                return redirect()->route('admin.2fa.verify');
            }
        }

        return $next($request);
    }
}
