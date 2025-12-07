<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Mail\Security\PasswordChanged;

class PengaturanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.settings.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        \Log::info('--- PROFILE UPDATE START ---');
        \Log::info('User ID: ' . $user->id . ' | Current Name: ' . $user->name);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
        ]);

        \Log::info('Validation Passed. Data to update: ', $validated);

        $updateResult = $user->update($validated);

        \Log::info('Update method returned: ' . ($updateResult ? 'true' : 'false'));
        \Log::info('Name in model after update: ' . $user->name);
        
        // Refresh model from DB to be 100% sure
        $user->refresh();
        \Log::info('Name in model after refreshing from DB: ' . $user->name);
        \Log::info('--- PROFILE UPDATE END ---');

        return redirect()->route('admin.settings.index')->with('success_profile', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        Log::info('Attempting to update password for user: ' . $user->email);

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    Log::warning('current_password check failed for user: ' . $user->email);
                    $fail('Password saat ini tidak cocok.');
                }
            }],
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($validator->fails()) {
            Log::error('Password update validation failed for user: ' . $user->email, $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Log::info('Password updated successfully for user: ' . $user->email);

        Mail::to($user->email)->send(new PasswordChanged($user));

        return back()->with('success_password', 'Password berhasil diperbarui!');
    }

    public function updateSecurity(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'two_factor_enabled' => 'required|boolean',
        ]);

        $user->two_factor_enabled = $request->two_factor_enabled;
        $user->save();

        return redirect()->route('admin.settings.index')->with('success_security', 'Pengaturan keamanan berhasil diperbarui!');
    }

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email_notifications' => 'nullable|boolean',
            'new_loan_notifications' => 'nullable|boolean',
            'return_notifications' => 'nullable|boolean',
            'schedule_notifications' => 'nullable|boolean',
            'notification_frequency' => 'required|string|in:realtime,hourly,daily,weekly',
        ]);

        $preferences = [
            'email_notifications' => $request->has('email_notifications'),
            'new_loan_notifications' => $request->has('new_loan_notifications'),
            'return_notifications' => $request->has('return_notifications'),
            'schedule_notifications' => $request->has('schedule_notifications'),
            'notification_frequency' => $request->notification_frequency,
        ];

        $user->notification_preferences = $preferences;
        $user->save();

        return back()->with('success_notifications', 'Pengaturan notifikasi berhasil diperbarui!');
    }

    public function updateSystemSettings(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'system_name' => 'required|string|max:255',
            'max_loan_days' => 'required|integer|min:1|max:30',
            'max_items_per_loan' => 'required|integer|min:1|max:20',
            'maintenance_mode' => 'required|boolean',
            'auto_approval' => 'required|boolean',
            'late_fine_notification' => 'required|boolean',
            'fine_amount_per_day' => 'required|integer|min:0',
        ]);

        $user->system_settings = $validated;
        $user->save();

        return back()->with('success_system', 'Pengaturan sistem berhasil diperbarui!');
    }
}
