<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsKaryawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(auth()->user()->role_id) && auth()->user()->role_id == 2) {
            return $next($request);
        }

        return redirect('home')->with('error', "Anda tidak memiliki akses sebagai karyawan.");
    }
}
