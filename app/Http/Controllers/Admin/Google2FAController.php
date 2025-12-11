<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Add these use statements
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class Google2FAController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate the 2FA secret and QR code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setup(Request $request)
    {
        try {
            $user = \App\Models\User::find(Auth::id());
            // If for some reason the user is not found, though highly unlikely after authentication
            if (!$user) {
                throw new \Exception('Authenticated user not found.');
            }
            $google2fa = app(\PragmaRX\Google2FA\Google2FA::class);

            // Generate a new secret key
            $user->google2fa_secret = $google2fa->generateSecretKey();
            
            // Generate recovery codes
            $recoveryCodes = [];
            for ($i = 0; $i < 8; $i++) {
                $recoveryCodes[] = random_int(100000, 999999);
            }
            
            // Encrypt and save recovery codes as JSON
            $user->google2fa_recovery_codes = encrypt(json_encode($recoveryCodes));
            $user->save();
            
            // Manually build the OTP Auth URI
            $otpAuthUri = "otpauth://totp/" . rawurlencode(config('app.name', 'Laravel')) . ":" . rawurlencode($user->email) . "?secret=" . $user->google2fa_secret . "&issuer=" . rawurlencode(config('app.name', 'Laravel'));

            // Use BaconQrCode to generate SVG data
            $renderer = new ImageRenderer(
                new RendererStyle(256), // size of the QR code
                new SvgImageBackEnd()
            );
            $writer = new Writer($renderer);
            $svg = $writer->writeString($otpAuthUri);
            
            // Create a base64 Data URI for the SVG
            $qrCodeDataUri = 'data:image/svg+xml;base64,' . base64_encode($svg);

            return response()->json([
                'qr_code_url' => $qrCodeDataUri,
                'recovery_codes' => $recoveryCodes,
            ]);
        } catch (\Exception $e) {
            // Return the error message from the server to the frontend
            return response()->json(['message' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Activate 2FA for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = \App\Models\User::find(Auth::id());
        $google2fa = app(\PragmaRX\Google2FA\Google2FA::class);

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->otp);

        if ($valid) {
            $user->two_factor_enabled = true;
            $user->save();
            return response()->json(['message' => '2FA has been activated successfully!']);
        }

        return response()->json(['message' => 'Invalid OTP code. Please try again.'], 422);
    }

    /**
     * Disable 2FA for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());
        if (!$user) {
            return response()->json(['message' => 'Authenticated user not found.'], 404);
        }
        $user->google2fa_secret = null;
        $user->google2fa_recovery_codes = null;
        $user->two_factor_enabled = false;
        $user->save();

        return response()->json(['message' => '2FA has been disabled successfully!']);
    }

    /**
     * Show the 2FA verification form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVerifyForm()
    {
        return view('admin.auth.2fa');
    }

    /**
     * Verify the 2FA OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = \App\Models\User::find(Auth::id());
        if (!$user) {
            return response()->json(['message' => 'Authenticated user not found.'], 404);
        }

        $google2fa = app(\PragmaRX\Google2FA\Google2FA::class);

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->otp);

        if ($valid) {
            // 2FA passed, forget the 'in progress' flag
            $request->session()->forget('2fa_in_progress');
            
            // Regenerate session to finalize login
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
    }
}
