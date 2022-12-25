@extends('backend.layouts.main')

@section('container')
    <div class="container">
        <div class="alert alert-success mb-4">
            <h4>Konfirmasi Lupa Password!</h4>
            <hr class="line">
            <p class="mt-3">Anda berhasil memberikan akses user untuk lupa kata sandi.</p>
            <p class="mt-3">
                <strong>Nama Pengguna:</strong>
                {{ $user->name }}
            </p>
            <p class="mt-2">
                <strong style="width:100%; max-widht: 300px;">Email:</strong>
                {{ $user->email }}
            </p>
            <p class="mt-2">
                <strong>Kode Puskesmas:</strong>
                {{ $user->puskesmas_code }}
            </p>
            <p class="mt-2">
                <strong>Role:</strong>
                {{ $user->role_name }}
            </p>
            <p class="mt-2">
                <strong>Token:</strong>
                <span class="text-success">
                    {{ $user->forgot_password_token }}
                </span>
            </p>

            <p class="mt-4">Harap segera lakukan lupa kata sandi.</p>
        </div>
        <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn-custom btn-next">
            <i class="fas fa-arrow-left"></i>
            Kembali ke edit
        </a>
    </div>
@endsection
