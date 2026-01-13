<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\Fast2SmsService;

class LoginController extends Controller
{
    protected $redirectTo = '/home';
    protected $smsService;

    public function __construct(Fast2SmsService $smsService)
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
        $this->smsService = $smsService;
    }

    public function loginAsOfficial()
    {
        return view('home.loginasofficial');
    }

    public function loginAsFarmer()
    {
        return view('home.loginasfarmer');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('home.loginasofficial');
    }


    /**
     * Handle login (PHONE + PASSWORD)
     */
    public function login(Request $request)
    {
        /* ---------------- VALIDATION ---------------- */
        $request->validate([
            'phone'    => ['required', 'digits:10'],
            'password' => ['required'],
            'captcha'  => ['required'],
        ]);

        if ($request->captcha !== session('captcha')) {
            return back()->withErrors([
                'captcha' => 'Invalid captcha'
            ])->withInput();
        }

        session()->forget('captcha');

        /* ---------------- USER CHECK ---------------- */
        $user = User::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'phone' => 'Invalid phone or password'
            ])->withInput();
        }

        /* ---------------- GENERATE OTP ---------------- */
        // $otp = rand(100000, 999999);


        // $otp = rand(100000, 999999);
        $otp = 100000;
        $response = $this->smsService->sendOtp($request->phone, $otp);

        // Save OTP (DB or session)
        $user->update([
            'otp_code'       => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(5),
            'otp_verified'   => false,
        ]);

        session([
            'otp_user_id' => $user->id
        ]);

        // TODO: Send OTP via SMS API here
        // sendOtp($user->phone, $otp);

        return redirect()->route('farmer.otp.form');
    }


    public function otpForm()
    {
        if (!session('otp_user_id')) {
            return redirect()->route('loginas.farmer');
        }

        return view('home.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $user = User::find(session('otp_user_id'));

        if (! $user) {
            return redirect()->route('loginas.farmer');
        }

        /* -------- OTP Expiry Check -------- */
        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired. Please login again.']);
        }

        /* -------- OTP Match Check -------- */
        if (! Hash::check($request->otp, $user->otp_code)) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        /* -------- OTP Verified -------- */
        $user->update([
            'otp_verified' => true,
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        session()->forget('otp_user_id');

        Auth::login($user);
        return redirect($this->redirectTo);
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginas.farmer');
    }
}
