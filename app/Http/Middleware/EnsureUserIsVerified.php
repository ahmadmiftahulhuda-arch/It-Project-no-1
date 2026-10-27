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
            $referer = $request->headers->get('referer');
            $currentUrl = $request->fullUrl();

            // Jika ada referer dan bukan URL yang sama, kembali ke halaman sebelumnya
            if ($referer && $referer !== $currentUrl) {
                return redirect()->back()
                    ->with('error', '⚠️ Akun Anda harus diverifikasi oleh admin untuk mengakses fitur ini. Mohon hubungi administrator.');
            }

            // Jika diakses langsung, redirect aman ke user dashboard atau home
            return redirect()->route('user.dashboard')
                ->with('error', '⚠️ Akun Anda harus diverifikasi oleh admin untuk membuat peminjaman. Mohon hubungi administrator.');
        }

        return $next($request);
    }
}