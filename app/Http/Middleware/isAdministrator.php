<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $authentic)
    {
        $isAdmin = Auth::user()->role_id;
        if ($isAdmin == $authentic) {
            return $next($request);
        } else {
            if ($isAdmin == 1)
                return redirect('/administrator');
            else if ($isAdmin == 2)
                return redirect('/viewer');
            else if ($isAdmin == 3)
                return redirect('/dashboard');
            else
                return redirect('/');
        }
    }
}
