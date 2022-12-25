@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <h4 class="content-title">Kata Sandi</h4>
            <form action="{{ route('dashboard.account.password.update') }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="old_password">Kata Sandi Lama</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                name="old_password" id="old_password" required>
                            @error('old_password')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="new_password">Kata Sandi Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                name="new_password" id="new_password" required>
                            @error('new_password')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="conf_new_password">Konfirmasi Kata Sandi
                                Baru</label>
                            <input type="password" class="form-control @error('conf_new_password') is-invalid @enderror"
                                name="conf_new_password" id="conf_new_password">
                            @error('conf_new_password')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-custom btn-submit mt-3">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
