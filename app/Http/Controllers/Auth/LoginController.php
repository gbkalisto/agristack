<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('index');
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

        if ($request->captcha !== Session::get('captcha')) {
            throw ValidationException::withMessages([
                'captcha' => 'Invalid captcha',
            ]);
        }

        Session::forget('captcha');

        /* ---------------- AUTH ATTEMPT ---------------- */
        if (!Auth::attempt([
            'phone' => $request->phone,
            'password' => $request->password,
        ], $request->boolean('remember'))) {

            throw ValidationException::withMessages([
                'phone' => 'Invalid phone or password',
            ]);
        }

        /* ---------------- SUCCESS ---------------- */
        $request->session()->regenerate();

        return response()->json([
            'status'   => true,
            'message'  => 'Login successful',
            'redirect' => url($this->redirectTo),
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
