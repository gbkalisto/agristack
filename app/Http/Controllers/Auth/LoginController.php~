<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // public function otpForm()
    // {
    //     return view('auth.otp');
    // }

    // send otp on registed number
    // public function sendOtp(Request $request)
    // {
    //     // 🔹 Manual validation to control JSON response
    //     $validator = Validator::make($request->all(), [
    //         'mobile' => 'required|digits:10',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => $validator->errors()->first(),
    //         ], 422);
    //     }
    //     /* ---------------- SECURITY CHECK ---------------- */
    //     if (session('otp_guard') !== 'web') {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Unauthorized access',
    //         ], 403);
    //     }
    //     $user = User::find(session('otp_user_id'));
    //     if (!$user) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'User not found',
    //         ], 404);
    //     }

    //     /* ---------------- GENERATE OTP ---------------- */
    //     //$otp = rand(100000, 999999);
    //     $otp = 100000; // For testing purpose

    //     $user->update([
    //         'otp' => Hash::make($otp),
    //         'otp_expires_at' => now()->addMinutes(5),
    //         'otp_verified' => false,
    //     ]);

    //     /* ---------------- SEND OTP (SMS API) ---------------- */
    //     //$this->sendOtpSms($user->mobile, $otp);
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'OTP sent successfully'
    //     ]);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     /* ---------------- VALIDATION ---------------- */
    //     try {
    //         $request->validate([
    //             'otp' => 'required|digits:6',
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => $e->errors()['otp'][0] ?? 'Invalid OTP',
    //         ], 422);
    //     }

    //     /* ---------------- SESSION CHECK ---------------- */
    //     if (session('otp_guard') !== 'web' || ! session()->has('otp_user_id')) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Session expired. Please login again.',
    //         ], 401);
    //     }

    //     $userId = session('otp_user_id');

    //     /* ---------------- FETCH ADMIN ---------------- */
    //     $user = User::find($userId);

    //     if (!$user) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'User not found.',
    //         ], 404);
    //     }

    //     /* ---------------- OTP EXPIRE CHECK ---------------- */
    //     if (!$user->otp_expires_at || now()->gt($user->otp_expires_at)) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'OTP expired.',
    //         ], 422);
    //     }

    //     /* ---------------- OTP MATCH ---------------- */
    //     if (!Hash::check($request->otp, $user->otp)) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Invalid OTP.',
    //         ], 422);
    //     }

    //     /* ---------------- SUCCESS ---------------- */
    //     $user->update([
    //         'otp'            => null,
    //         'otp_verified'   => true,
    //         'otp_expires_at' => null,
    //     ]);

    //     Auth::guard('account')->login($user);

    //     session()->forget([
    //         'otp_pending',
    //         'otp_guard',
    //         'otp_user_id',
    //     ]);

    //     return response()->json([
    //         'status'   => true,
    //         'message'  => 'Verified successfully',
    //         'redirect' => route('home'),
    //     ]);
    // }
}
