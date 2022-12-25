<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $remember_me = isset($request->remember_me) ? true : false;

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ], [], ['password' => 'Kata Sandi']);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email);

        if ($user->count() > 0) {
            $user = $user->first();
            $user->tokens()->delete();
            if (!$user->first()->is_active) {
                return back()
                    ->with([
                        'status' => 'danger',
                        'msg' => 'Akun anda dinonaktifkan. Silahkan hubungi Administrator.'
                    ])
                    ->withInput();
            }

            if (Hash::check($password, $user->password)) {
                Auth::login($user, $remember_me);

                $token = $user->createToken('simkesda_token');

                $request->session()
                    ->regenerate();

                $user = $user->update(['last_login' => date('Y-m-d H:i:s')]);

                return redirect()
                    ->route('dashboard');
            }
        }

        return redirect()
            ->route('login')
            ->with([
                'status' => 'warning',
                'msg' => 'Autentikasi tidak sesuai.'
            ])
            ->withInput();
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }
}
