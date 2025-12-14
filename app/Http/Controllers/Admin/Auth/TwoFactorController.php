<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    public function showSetupForm(Request $request, Google2FA $google2fa)
    {
        $admin  = auth('admin')->user();
        // generate & stash secret in session (NOT in the form!)
        $secret = $google2fa->generateSecretKey();
        $request->session()->put('2fa:secret', $secret);

        $qrCodeInline = $google2fa->getQRCodeInline(
            config('app.name'),
            $admin->email,
            $secret
        );
        return view('admin.auth.2fa-setup', [
            'qrCode' => $qrCodeInline,
        ]);
    }


    public function storeSetup(Request $request, \PragmaRX\Google2FAQRCode\Google2FA $google2fa)
    {
        $request->validate([
            'code' => 'required|string|size:6', // keep as string
        ]);

        $secret = $request->session()->get('2fa:secret');
        if (!$secret) {
            return back()->withErrors(['code' => 'Setup session expired, please restart 2FA setup.']);
        }

        $code = preg_replace('/\s+/', '', $request->input('code'));

        // DEBUG: see what the server thinks the current OTP is
        $current = $google2fa->getCurrentOtp($secret);
        \Log::info('2FA debug', [
            'secret'   => $secret,
            'server_otp' => $current,
            'user_code'  => $code,
            'time'       => now()->toIso8601String(),
        ]);
        $window = 8; // +/- 4 time-steps of 30s
        $valid = $google2fa->verifyKey($secret, $code, $window);

        if (!$valid) {
            return back()->withErrors(['code' => 'Invalid or expired code.'])->withInput();
        }

        $admin = auth('admin')->user();
        $admin->google2fa_secret  = Crypt::encryptString($secret);
        $admin->google2fa_enabled = true;
        $admin->save();

        $request->session()->forget('2fa:secret');

        return redirect()->route('admin.profile')->with('success', '2FA Enabled!');
    }


    public function disable()
    {
        $admin = auth('admin')->user();

        if (!$admin->google2fa_enabled) {
            return response()->json([
                'status' => 'info',
                'message' => '2FA is already disabled.',
            ], 200);
        }

        $admin->google2fa_enabled = false;
        $admin->google2fa_secret = null;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => '2FA Disabled successfully',
        ]);
    }
}
