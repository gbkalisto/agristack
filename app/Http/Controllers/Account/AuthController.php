<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adminuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'    => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::guard('account')->attempt([
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'status' => 1
    //     ])) {
    //         return redirect()->route('account.dashboard');
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials']);
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required',
            'g-recaptcha-response'  => 'required',
        ]);

        /* ---------------- CAPTCHA VERIFY ---------------- */
        $captcha = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret'   => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (! $captcha->json('success')) {
            return back()->withErrors([
                'captcha' => 'Captcha verification failed'
            ]);
        }

        /* ---------------- CHECK USER ---------------- */
        $user = Adminuser::where('email', $request->email)
            ->orWhere('user_name', $request->email)
            ->where('status', 1)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        /* ---------------- GENERATE OTP ---------------- */
        // $otp = rand(100000, 999999);
        // $otp = 000000; // For testing purpose

        // $user->update([
        //     'otp' => Hash::make($otp),
        //     'otp_expires_at' => now()->addMinutes(5),
        //     'otp_verified' => false,
        // ]);

        /* ---------------- SEND OTP (SMS API) ---------------- */
        // Example
        // $this->sendOtpSms($user->mobile, $otp);

        /* ---------------- STORE TEMP SESSION ---------------- */
        // session([
        //     'otp_account_id' => $user->id
        // ]);

        return redirect()->route('account.otp.form');
    }

    // otp verification and login
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = AdminUser::find(session('otp_account_id'));

        if (! $user) {
            return redirect()->route('login')->withErrors([
                'otp' => 'Session expired'
            ]);
        }

        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }

        if (! Hash::check($request->otp, $user->otp)) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        /* ---------------- SUCCESS ---------------- */
        $user->update([
            'otp' => null,
            'otp_verified' => true,
            'otp_expires_at' => null,
        ]);

        Auth::guard('account')->login($user);
        session()->forget('otp_account_id');

        // return redirect()->route('account.dashboard');
        return 'Verified Successfully';
    }


    public function logout()
    {
        Auth::guard('account')->logout();
        return redirect()->route('account.login');
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
