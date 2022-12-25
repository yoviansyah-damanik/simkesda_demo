@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <form action="" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="name">Nama Pengguna</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="puskesmas_code">Kode
                                Puskesmas <span class="text-danger small fw-light">(kosongkan jika bukan
                                    puskesmas)</span></label>
                            <input type="number" class="form-control @error('puskesmas_code') is-invalid @enderror"
                                name="puskesmas_code" id="puskesmas_code"
                                value="{{ old('puskesmas_code', $user->puskesmas_code) }}" required>
                            @error('puskesmas_code')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="name">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" name="role" id="role"
                                required>
                                <option value="" hidden>--Pilih role--</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if (old('role', $user->role_name) == $role->name) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-custom btn-submit mt-4">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </form>
        </div>

        <div class="content mt-3">
            @if (!$user->is_forgot_password)
                <p class="mb-0">
                    Berikan akses untuk lupa kata sandi kepada pengguna.
                </p>
                <form method="post" action="{{ route('dashboard.user.reset', $user->id) }}">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-dark mt-4">
                        <i class="fas fa-unlock"></i>
                        Beri Akses
                    </button>
                </form>
            @else
                <p class="mb-3">
                    Token lupa kata sandi: <span class="text-success fw-bold">{{ $user->forgot_password_token }}</span>
                </p>
                <p>
                    Berikan token ini kepada pengguna, kemudian masukkan token ini pada field "Token" di halaman
                    lupa kata sandi.
                </p>

                <form method="post" action="{{ route('dashboard.user.reset', $user->id) }}">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-dark mt-4">
                        <i class="fas fa-lock"></i>
                        Tutup Akses
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
