@extends('auth.layouts.auth')

@section('content')
    <div class="container-fluid p-0 overflow-hidden vw-100 vh-100" id="authenticate">
        <div class="position-absolute top-50 start-50 translate-middle" style="width:100%; max-width:1200px;">
            <div class="card p-0 border-0 overflow-hidden h-100 m-3 shadow">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-5 position-relative d-none d-md-block position-relative overflow-hidden">
                            <img class="position-absolute top-50 start-50 translate-middle"
                                src="{{ asset('images/komplek-perkantoran.jpg') }}" alt="Login Background">
                            <div class="opacity-50 bg-dark position-absolute top-0 bottom-0 start-0 end-0"></div>
                        </div>
                        <div class="col-md-7">
                            <form action="{{ route('password.update', ['token' => $token]) }}" method="post"
                                class="p-4 mx-auto p4-0 py-md-5 authentice-form">
                                @csrf
                                <img class="position-relative top-0 start-50 translate-middle-x"
                                    src="{{ asset('images/logo-dinkes.png') }}" alt="Logo Dinkes"
                                    style="width:100%; max-width:250px">

                                <h5 class="fw-semibold text-center mt-3 text-uppercase">
                                    Kata Sandi Baru
                                </h5>
                                <div class="text-center mb-3">
                                    <p class="text-muted m-0 lh-1">
                                        Silahkan masukkan kata sandi baru.
                                    </p>
                                </div>

                                @if (session('msg'))
                                    <div class="alert alert-{{ session('status') ?? 'warning' }} py-2 alert-dismissible fade show"
                                        role="alert">
                                        {{ session('msg') }}
                                        <button type="button"
                                            class="btn-close text-sm position-absolute top-50 end-0 translate-middle-y"
                                            data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="form-group mt-4 mb-2">
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white" id="basic-addon1">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" name="new_password" id="new_password" class="form-control"
                                            placeholder="Kata sandi baru" autofocus required>
                                    </div>
                                    @error('new_password')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white" id="basic-addon1">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" name="conf_password" id="conf_password" class="form-control"
                                            placeholder="Ulangi kata sandi baru" required>
                                    </div>
                                    @error('conf_password')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary mt-3 w-100 rounded-pill" type="submit">
                                    <i class="fas fa-save"></i>
                                    Simpan
                                </button>

                                <div class="mt-5">
                                    <div class="row g-0">
                                        <div class="col-6">
                                            <a class="link link-start" href="{{ route('homepage') }}">
                                                <i class="fas fa-arrow-left"></i>
                                                Kembali ke Beranda
                                            </a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="link link-end" href="{{ route('login') }}">
                                                Masuk
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
