<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // Pemeriksaan berdasarkan peran
            if ($this->hasRole($user, $role)) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Anda tidak memiliki hak akses yang diperlukan.');
    }

    // Metode untuk memeriksa peran pengguna
    private function hasRole($user, $role)
    {
        if ($role === 'admin' && $user instanceof \App\Models\Admin) {
            return true;
        }

        if ($role === 'user' && $user instanceof \App\Models\User) {
            return true;
        }

        return false;
    }
}
