<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();

            if ($remember) {
                Cookie::queue('admin_email', encrypt($request->email), 60 * 24 * 30); // 30 days
                Cookie::queue('admin_password', encrypt($request->password), 60 * 24 * 30); // 30 days
            } else {
                Cookie::queue(Cookie::forget('admin_email'));
                Cookie::queue(Cookie::forget('admin_password'));
            }

            if ($admin->google2fa_enabled) {
                session(['admin_2fa:id' => $admin->id]);
                return redirect()->route('admin.2fa.verify');
            }

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }

    /**
     * Log the admin out of the application.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
/*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    | | All authentication guards have a user provider, which defines how
    | the users are actually retrieved out of your database or other
    | storage system used by the application. Typically, Eloquent
    | is utilized.
    | Supported: "session"
    | */
