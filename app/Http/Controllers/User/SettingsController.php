<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    /**
     * Display the user settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ensure notification_preferences is an array, even if null in DB
        $user->notification_preferences = (array) json_decode($user->notification_preferences, true);

        return view('user.settings.index', compact('user'));
    }

    /**
     * Update the user settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate only for email preferences
        $request->validate([
            'email_status_updates' => 'nullable|boolean',
            'email_reminders' => 'nullable|boolean',
        ]);

        // Notification preferences setting only for email
        $notificationPreferences = [
            'email' => [
                'status_updates' => $request->has('email_status_updates'),
                'reminders' => $request->has('email_reminders'),
            ],
            // WhatsApp settings are removed from here, as it will be automatic
        ];
        
        $user->notification_preferences = json_encode($notificationPreferences);

        // Basic Security Settings (2FA)
        if ($request->has('two_factor_enabled')) {
            // For simplicity, we just toggle the boolean. Actual 2FA setup involves QR codes, secret generation, etc.
            // This placeholder assumes 2FA setup would happen in a separate flow or this toggles its activation after setup.
            $user->two_factor_enabled = true;
        } else {
            $user->two_factor_enabled = false;
            // When 2FA is disabled, clear the secret and recovery codes for security
            $user->two_factor_secret = null;
            $user->two_factor_recovery_codes = null;
        }

        $user->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
