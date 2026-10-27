<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnsureSingleSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $currentSessionId = session()->getId();

            // Hapus semua session lain milik user ini dalam satu query efisien
            try {
                DB::table('sessions')
                    ->where('user_id', Auth::id())
                    ->where('id', '!=', $currentSessionId)
                    ->delete();
            } catch (\Throwable $e) {
                // Abaikan jika driver session bukan database
            }
        }

        return $next($request);
    }
}
