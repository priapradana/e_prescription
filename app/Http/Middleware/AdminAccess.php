<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki role = (Admin)
        // dd('Admin middleware works!');
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman utama
        return redirect('/admin/login')->with('error', 'Unauthorized access.');
    }
}

