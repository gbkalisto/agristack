<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccountAuth
{
    public function handle($request, Closure $next)
    {
        if (! Auth::guard('account')->check()) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
