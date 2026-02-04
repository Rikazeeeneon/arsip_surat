<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // jika belum login → arahkan ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // jika role tidak sesuai → tolak HALUS
      if (!in_array(Auth::user()->role, $roles)) {
    return redirect()->route('dashboard');
}

        return $next($request);
    }
}
