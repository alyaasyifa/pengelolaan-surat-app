<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        //cek apakah auth mendeteksi ada data login
        if(Auth::check()) {
            //kalau ada, diperbolehkan mengakses route terkait
            return $next($request);
        } else {
            //jika tidak ada, diarahkan ke route tertentu dengan session message
            return redirect()->route('login')->with('canAccess', 'Silahkan login terlebih dahulu!');
        }
    }
}
