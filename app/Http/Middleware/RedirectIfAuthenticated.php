<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
