<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;

class TwoFactorVerifyController extends Controller
{
    public function showVerifyForm()
    {
        if (!session()->has('admin_2fa:id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.auth.2fa-verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $admin = Admin::find(session('admin_2fa:id'));

        if (! $admin) {
            return redirect()->route('admin.login')->withErrors(['email' => 'Invalid session']);
        }

        $google2fa = new Google2FA();

        if ($google2fa->verifyKey($admin->google2fa_secret, $request->code)) {
            session()->forget('admin_2fa:id');
            Auth::guard('admin')->login($admin);
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid code']);
    }
}
