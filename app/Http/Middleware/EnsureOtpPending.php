<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureOtpPending
{
    public function handle($request, Closure $next)
    {
        if (
            ! session()->has('otp_pending') ||
            ! session()->has('otp_guard') ||
            ! session()->has('otp_user_id')
        ) {
            // return redirect()->route('login');
            return redirect()->to('/');
        }

        return $next($request);
    }
}
