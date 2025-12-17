<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('account.auth.login');
    }

    public function otpForm()
    {
        return view('account.auth.otp');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'    => 'required',
            'password' => 'required',
            'captcha'    => 'required|string',
        ]);

        if ($request->captcha !== Session::get('captcha')) {
            return back()->withErrors(['captcha' => 'Invalid Captcha']);
        }
        Session::forget('captcha');
        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        if (Auth::guard('account')->attempt([
            $loginField => $request->username,
            'password' => $request->password,
            'status' => 1
        ])) {
            return redirect()->route('account.otp.form');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }



    // send otp on registed number
    public function sendOtp(Request $request)
    {
        // 🔹 Manual validation to control JSON response
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
        $user = AdminUser::where('mobile', $request->mobile)
            ->where('status', 1)
            ->first();

        if (! $user) {
            return response()->json([
                'status'  => false,
                'message' => 'Mobile number not found',
            ], 404);
        }

        /* ---------------- GENERATE OTP ---------------- */
        // $otp = rand(100000, 999999);
        $otp = 100000; // For testing purpose

        $user->update([
            'otp' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(5),
            'otp_verified' => false,
        ]);

        /* ---------------- SEND OTP (SMS API) ---------------- */
        //$this->sendOtpSms($user->mobile, $otp);

        /* ---------------- STORE TEMP SESSION ---------------- */
        session([
            'otp_account_id' => $user->id
        ]);

        // return response in json
        return response()->json(['status' => true, 'message' => 'OTP sent successfully']);
    }

    // otp verification and login
    public function verifyOtp(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required|digits:6',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->errors()['otp'][0] ?? 'Invalid OTP'
            ], 422);
        }

        $userId = session('otp_account_id');

        if (! $userId) {
            return response()->json([
                'status'  => false,
                'message' => 'Session expired. Please login again.'
            ], 401);
        }

        $user = AdminUser::find($userId);

        if (! $user) {
            return response()->json([
                'status'  => false,
                'message' => 'User not found.'
            ], 404);
        }

        if (now()->gt($user->otp_expires_at)) {
            return response()->json([
                'status'  => false,
                'message' => 'OTP expired.'
            ], 422);
        }

        if (! Hash::check($request->otp, $user->otp)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid OTP.'
            ], 422);
        }

        // ✅ SUCCESS
        $user->update([
            'otp'             => null,
            'otp_verified'    => true,
            'otp_expires_at'  => null,
        ]);

        Auth::guard('account')->login($user);
        session()->forget('otp_account_id');

        return response()->json([
            'status'   => true,
            'message'  => 'Verified successfully',
            'redirect' => route('account.dashboard'),
        ]);
    }



    public function logout()
    {
        Auth::guard('account')->logout();
        // return redirect()->route('account.login');
        return redirect()->to('/');
    }

    // Example function to send OTP via SMS API
    protected function sendOtpSms($mobile, $otp)
    {
        Http::post('SMS_API_URL', [
            'mobile' => $mobile,
            'message' => "Your OTP is {$otp}. Valid for 5 minutes."
        ]);
    }
}
