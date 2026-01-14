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
use App\Services\Fast2SmsService;

class AuthController extends Controller
{
    protected $smsService;

    public function __construct(Fast2SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function stepForm()
    {
        return view('account.form');
    }

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
        /* ---------------- VALIDATION ---------------- */
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha'  => 'required|string',
        ]);


        if ($request->captcha !== session('captcha')) {
            return back()
                ->withErrors(['captcha' => 'Invalid Captcha'])
                ->withInput();
        }

        session()->forget('captcha');


        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'user_name';

        // $user = AdminUser::where($loginField, $request->username)
        //     ->where('status', 1)
        //     ->first();
        $user = AdminUser::where($loginField, $request->username)->first();
        if (! $user) {
            return back()
                ->withErrors(['username' => 'Invalid credentials'])
                ->withInput();
        }


        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     return back()
        //         ->withErrors(['username' => 'Invalid credentials'])
        //         ->withInput();
        // }

        if (! Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['username' => 'Invalid credentials'])
                ->withInput();
        }

        if ($user->status == 0) {
            return back()
                ->withErrors(['username' => 'Your account is inactive. Please contact admin.'])
                ->withInput();
        }

        session([
            'otp_pending' => true,
            'otp_guard'   => 'account',
            'otp_user_id' => $user->id,
        ]);

        return redirect()->route('account.otp.form');
    }


    // send otp on registed number
    public function sendOtp(Request $request)
    {
        // 🔹 Manual validation to control JSON response
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
        /* ---------------- SECURITY CHECK ---------------- */
        if (session('otp_guard') !== 'account') {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized access',
            ], 403);
        }
        $user = AdminUser::find(session('otp_user_id'));
        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'Account not found',
            ], 404);
        }

        /* ---------------- GENERATE OTP ---------------- */
        $otp = rand(100000, 999999);
        // $otp = 100000; // For testing purpose
        $response = $this->smsService->sendOtp($request->phone, $otp);

        $user->update([
            'otp' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(5),
            'otp_verified' => false,
        ]);

        /* ---------------- SEND OTP (SMS API) ---------------- */
        //$this->sendOtpSms($user->mobile, $otp);
        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully'
        ]);
    }


    public function verifyOtp(Request $request)
    {
        /* ---------------- VALIDATION ---------------- */
        try {
            $request->validate([
                'otp' => 'required|digits:6',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->errors()['otp'][0] ?? 'Invalid OTP',
            ], 422);
        }

        /* ---------------- SESSION CHECK ---------------- */
        if (session('otp_guard') !== 'account' || ! session()->has('otp_user_id')) {
            return response()->json([
                'status'  => false,
                'message' => 'Session expired. Please login again.',
            ], 401);
        }

        $accountId = session('otp_user_id');

        /* ---------------- FETCH ADMIN ---------------- */
        $admin = AdminUser::find($accountId);

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'Account not found.',
            ], 404);
        }

        /* ---------------- OTP EXPIRE CHECK ---------------- */
        if (!$admin->otp_expires_at || now()->gt($admin->otp_expires_at)) {
            return response()->json([
                'status'  => false,
                'message' => 'OTP expired.',
            ], 422);
        }

        /* ---------------- OTP MATCH ---------------- */
        if (!Hash::check($request->otp, $admin->otp)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid OTP.',
            ], 422);
        }

        /* ---------------- SUCCESS ---------------- */
        $admin->update([
            'otp'            => null,
            'otp_verified'   => true,
            'otp_expires_at' => null,
        ]);

        Auth::guard('account')->login($admin);

        session()->forget([
            'otp_pending',
            'otp_guard',
            'otp_user_id',
        ]);

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
