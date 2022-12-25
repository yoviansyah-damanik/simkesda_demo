@extends('backend.layouts.main')

@section('container')
    <div class="container">
        <div class="alert alert-success mb-4">
            <h4>Sukses!</h4>
            <hr class="line">
            <p class="mt-3">Anda berhasil menambahkan user dengan data berikut ini.</p>
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
                {{ $user->puskesmas_code ?? '-' }}
            </p>
            <p class="mt-2">
                <strong>Role:</strong>
                {{ $user->role_name }}
            </p>
            <p class="mt-2">
                <strong>Kata Sandi:</strong>
                {{ Request::session()->get('password_user') }}
            </p>

            <p class="mt-4">Harap segera lakukan penggantian kata sandi untuk menghindari penyalahgunaan akun.</p>
        </div>
        <a href="{{ route('dashboard.user') }}" class="btn-custom btn-next">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>
@endsection
