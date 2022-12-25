<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function index()
    {
        return view('backend.pages.account.index');
    }

    public function password()
    {
        return view('backend.pages.account.password');
    }

    public function update_account(Request $request)
    {
        if (Auth::user()->role_name == 'Puskesmas') {
            $rules = [
                'email' => 'required|email:dns|unique:users,email,' . Auth::id(),
                'name' => 'required',
                'puskesmas_code' => 'nullable|unique:users,puskesmas_code,' . Auth::id(),
                'head_of_puskesmas' => 'required|max:255|string',
                'head_of_puskesmas_nip' => 'required|numeric'
            ];
        } else {
            $rules = [
                'email' => 'required|email:dns|unique:users,email,' . Auth::id(),
                'name' => 'required',
                'puskesmas_code' => 'nullable|unique:users,puskesmas_code,' . Auth::id()
            ];
        }

        $request->validate(
            $rules,
            [],
            [
                'name' => 'Nama Puskesmas',
                'head_of_puskesmas' => 'Nama Kepala Puskesmas',
                'head_of_puskesmas_nip' => 'NIP'
            ]
        );

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->puskesmas_code = $request->puskesmas_code;
        $user->head_of_puskesmas = $request->head_of_puskesmas ?? null;
        $user->head_of_puskesmas_nip = $request->head_of_puskesmas_nip ?? null;
        $user->save();

        Alert::success('Sukses!', 'Berhasil mengubah informasi akun.');
        return back();
    }

    public function update_password(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required|password',
                'new_password' => 'required|min:8',
                'conf_new_password' => 'same:new_password'
            ],
            [],
            [
                'old_password' => 'Kata Sandi Lama',
                'new_password' => 'Kata Sandi Baru',
                'conf_new_password' => 'Konfirmasi Kata Sandi Baru',
            ]
        );

        $user = User::find(Auth::id());
        $user->password = bcrypt($request->new_password);
        $user->save;

        Alert::success('Sukses!', 'Berhasil mengubah kata sandi akun.');
        return back();
    }
}
