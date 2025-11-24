<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GoogleAuthController extends Controller
{
    // Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // ✅ Batasi hanya akun kampus
            $email = $googleUser->getEmail();
            $allowedDomains = ['@politala.ac.id', '@mhs.politala.ac.id'];
            $isAllowed = false;

            foreach ($allowedDomains as $domain) {
                if (str_ends_with($email, $domain)) {
                    $isAllowed = true;
                    break;
                }
            }

            if (!$isAllowed) {
                return redirect('/login')->with('error', 'Hanya email institusi Politala (@politala.ac.id atau @mhs.politala.ac.id) yang diizinkan.');
            }

            // Cek apakah user sudah ada
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Buat user baru otomatis
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // password random, tidak dipakai
                ]);
            }

            // Login user
            Auth::login($user, true);

            return redirect('/home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login gagal, coba lagi.');
        }
    }
}
