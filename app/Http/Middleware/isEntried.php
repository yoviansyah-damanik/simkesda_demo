<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class isEntried
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
        if (!in_array(Auth::user()->role_name, ['Superadmin', 'Administrator', 'Peninjau'])) {
            $kepala = Auth::user()->head_of_puskesmas;
            $nip = Auth::user()->head_of_puskesmas_nip;

            if (!$kepala || !$nip) {
                Alert::warning('Perhatian!', 'Silahkan isi data Kepala Puskesmas terlebih dahulu.');
                return redirect()
                    ->route('dashboard.account');
            }
        }

        return $next($request);
    }
}
