<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user(); // ← INI YANG TADI KURANG

        // Jika role tidak sesuai
        if ($user->role !== $role) {

            // Redirect sesuai role user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'super_admin') {
                return redirect()->route('super_admin.dashboard');
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}