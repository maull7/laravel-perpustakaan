<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna terautentikasi
        if (Auth::check()) {
            // Cek apakah pengguna bukan admin
            if (!Auth::user()->is_admin) {
                // Kode status 403 lebih sesuai untuk otorisasi
                abort(403, 'Unauthorized');
            }
        } else {
            // Jika pengguna tidak terautentikasi, kembalikan response 401
            return redirect('login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
