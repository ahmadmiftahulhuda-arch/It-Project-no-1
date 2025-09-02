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

            // Ambil semua session aktif untuk user ini
            $sessions = DB::table('sessions')
                ->where('user_id', Auth::id())
                ->pluck('id');

            // Hapus semua session lain selain session saat ini
            foreach ($sessions as $sessionId) {
                if ($sessionId !== $currentSessionId) {
                    DB::table('sessions')->where('id', $sessionId)->delete();
                }
            }
        }

        return $next($request);
    }
}
