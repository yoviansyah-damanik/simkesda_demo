<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends BackendController
{
    public function index()
    {
        $users = User::withTrashed()
            ->orderBy('deleted_at', 'asc')
            ->paginate(config('app.pagination_length'))
            ->withQueryString();

        return view('backend.pages.user.index', [
            'data' => $users
        ]);
    }

    public function create(Request $request)
    {
        $id = $request->id;

        if ($id) {
            if ($request->session()->get('id_user') == $id) {
                $user = User::find($id);
                return view('backend.pages.user.success', [
                    'user' => $user
                ]);
            } else {
                return redirect()
                    ->route('dashboard.user.create');
            }
        }

        $roles = Role::where('name', '!=', 'Superadmin')
            ->get();

        return view('backend.pages.user.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email:dns|unique:users',
                'puskesmas_code' => 'nullable',
                'role' => [
                    'required',
                    Rule::in(Role::get()->pluck('name'))
                ]
            ],
            [
                'name' => 'Nama Puskesmas',
                'puskesmas_code' => 'Kode Puskesmas',
                'role' => 'Role'
            ]
        );

        if ($validatedData['puskesmas_code'] == 0)
            $password = "Simkesda" . mt_rand(100, 999);
        else
            $password = "Simkesda" . $validatedData['puskesmas_code'];

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'puskesmas_code' => $request->puskesmas_code,
            'password' => bcrypt($password),
            'is_active' => 1
        ];

        $new_user =  User::create($data)
            ->assignRole($request->role);

        Alert::success('Sukses!', 'User berhasil ditambahkan.');
        $request->session()->put('id_user', $new_user->id);
        $request->session()->put('password_user', $password);

        return redirect()
            ->route('dashboard.user.create', ['id' => $new_user->id]);
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'Superadmin')
            ->get();

        return view('backend.pages.user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $data = User::find($id);

        $validatedData = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'puskesmas_code' => 'required',
                'role' => [
                    'required',
                    Rule::in(Role::get()->pluck('name'))
                ],
                'email' => [
                    'required',
                    'email:dns',
                    Rule::unique('users')->ignore($data->email, 'email'),
                ],
            ],
            [
                'name' => 'Nama Puskesmas',
                'puskesmas_code' => 'Kode Puskesmas',
                'role_id' => 'Role'
            ]
        );

        if ($validatedData->fails()) {
            return redirect()
                ->route('dashboard.user.edit', $data->id)
                ->withErrors($validatedData)
                ->withInput();
        }

        $update_data = [
            'name' => Str::upper($request->name),
            'email' => $request->email,
            'puskesmas_code' => $request->puskesmas_code,
            'role_id' => $request->role_id,
        ];

        $data->update($update_data);

        Alert::success('Sukses!', 'Berhasil mengubah data user.');
        return redirect()
            ->route('dashboard.user.edit', $data->id);
    }

    public function activation(Request $request, User $user)
    {
        $stat = $request->stat;

        $user->update(['is_active' => $stat]);

        Alert::success('Sukses!', 'Berhasil mengubah status pengguna.');
        return redirect()
            ->route('dashboard.user');
    }

    public function destroy(User $user)
    {
        $user->delete();

        Alert::success('Sukses!', 'Berhasil menghapus pengguna.');
        return back();
    }

    public function restore($id)
    {
        User::onlyTrashed()
            ->find($id)
            ->restore();

        Alert::success('Sukses!', 'Berhasil memulihkan pengguna.');
        return back();
    }

    public function reset(User $user)
    {
        if ($user->is_forgot_password) {
            $user->update([
                'is_forgot_password' => 0,
                'forgot_password_token' => null
            ]);
        } else {
            $user->update([
                'is_forgot_password' => 1,
                'forgot_password_token' => Str::random(10)
            ]);
        }

        return back();
    }
}
