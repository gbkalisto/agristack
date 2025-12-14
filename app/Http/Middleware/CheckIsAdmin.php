<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, string $guardToKeep): Response
    public function handle(Request $request, Closure $next, string $guardToKeep, ...$permissions): Response
    {
        // return $next($request);
        $guards = ['web', 'admin'];

        // foreach ($guards as $guard) {
        //     if ($guard !== $guardToKeep && Auth::guard($guard)->check()) {
        //         Auth::guard($guard)->logout();
        //     }
        // }

        // return $next($request);
        foreach ($guards as $guard) {
            if ($guard !== $guardToKeep && Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }

        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            abort(403, 'Unauthorized - Admin not authenticated.');
        }

        // If permissions are passed, check if the admin has at least one
        foreach ($permissions as $permission) {
            if (!$admin->can($permission)) {
                abort(403, 'Unauthorized - Missing permission: ' . $permission);
            }
        }

        return $next($request);
    }
}
