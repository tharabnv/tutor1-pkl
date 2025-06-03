<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class check_user_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->hasRole('Siswa')) { //Mengecek apakah user sudah login dan user punya role siswa
            abort(403, 'USER DOES NOT HAVE RIGHT ROLE'); //akan muncul seperti ini jika user blm dikasih role
        }

        return $next($request);
    }
}