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

            // --- Logika Ekstrak NIM ---
            $nim = null;
            // 1. Coba ekstrak angka dari nama pengguna Google
            $nimFromName = preg_replace('/[^0-9]/', '', $googleUser->getName());
            if (!empty($nimFromName)) {
                $nim = $nimFromName;
            } else {
                // 2. Jika di nama tidak ada, coba ekstrak dari bagian sebelum @ di email
                $emailLocalPart = explode('@', $googleUser->getEmail())[0];
                $nimFromEmail = preg_replace('/[^0-9]/', '', $emailLocalPart);
                if (!empty($nimFromEmail)) {
                    $nim = $nimFromEmail;
                }
            }
            // --- Akhir Logika Ekstrak NIM ---

            // Cek apakah user sudah ada atau buat user baru
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Jika user sudah ada, update NIM jika masih kosong
                if (is_null($user->nim) && !is_null($nim)) {
                    $user->nim = $nim;
                    $user->save();
                }
            } else {
                // Jika user belum ada, buat user baru dengan data dari Google + NIM
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'nim' => $nim, // Simpan NIM yang diekstrak
                    'password' => Hash::make(uniqid()), // Buat password random
                    'verified' => false, // Set terverifikasi ke false secara default
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
