<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function check(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email:dns',
                'token' => 'required'
            ]
        );
        $email = $request->email;
        $token = $request->token;
        $user = User::where('email', $email);

        if (!$user->count())
            return back()
                ->with([
                    'status' => 'warning',
                    'msg' => 'Pengguna tidak ditemukan.'
                ])
                ->withInput();

        if (!$user->first()->is_forgot_password)
            return back()
                ->with([
                    'status' => 'danger',
                    'msg' => 'Anda tidak dapat melakukan lupa sandi. Silahkan menghubungi Administrator untuk membuka akses lupa kata sandi.'
                ])
                ->withInput();

        if ($user->first()->forgot_password_token != $token)
            return back()
                ->with([
                    'status' => 'warning',
                    'msg' => 'Token tidak sesuai.'
                ])
                ->withInput();

        $new_token = Str::random(32);

        DB::table('password_resets')
            ->where('email', $email)
            ->delete();

        DB::table('password_resets')
            ->insert([
                'email' => $email,
                'token' => $new_token
            ]);

        return redirect()
            ->route('password.reset', ['token' => $new_token]);
    }

    public function reset($token)
    {
        $av = DB::table('password_resets')
            ->where('token', $token)
            ->count();

        if (!$av)
            return redirect()
                ->route('password.forgot');

        return view('auth.new-password', compact('token'));
    }

    public function update(Request $request, $token)
    {
        $valid = DB::table('password_resets')
            ->where('token', $token);

        if (!$valid)
            return redirect()
                ->route('password.forgot')
                ->with([
                    'status' => 'danger',
                    'msg' => 'Token yang anda masukkan mengalami masalah. Silahkan hubungi Administrator.'
                ]);

        $request->validate([
            'new_password' => 'required|min:8',
            'conf_password' => 'required|same:new_password',
        ], [], [
            'new_password' => 'Kata Sandi Baru',
            'conf_password' => 'Konfirmasi Kata Sandi',
        ]);

        $email = $valid->first()->email;

        User::where('email', $email)
            ->update([
                'is_forgot_password' => 0,
                'forgot_password_token' => null,
                'password' => bcrypt($request->new_password)
            ]);

        $valid->delete();

        return redirect()
            ->route('login')
            ->with([
                'status' => 'success',
                'msg' => 'Kata sandi berhasil disimpan. Silahkan masuk kembali.'
            ]);
    }
}
