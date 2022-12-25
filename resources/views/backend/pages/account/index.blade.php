@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <h4 class="content-title">Informasi Akun</h4>
            <form action="{{ route('dashboard.account.update') }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="name">Nama Pengguna</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="puskesmas_code">Kode Puskesmas
                                <span class="text-danger small fw-light">(kosongkan jika bukan puskesmas)</span> </label>
                            <input type="text" class="form-control" name="puskesmas_code"
                                value="{{ old('puskesmas_code', Auth::user()->puskesmas_code) }}">
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
                                id="email" value="{{ old('email', Auth::user()->email) }}" required>
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
                            <input type="text" class="form-control" value="{{ Auth::user()->role_name }}" readonly>
                        </div>
                    </div>
                </div>
                @role('Puskesmas')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label form-label-bold" for="head_of_puskesmas">Nama Kepala Puskesmas</label>
                                <input type="text" class="form-control @error('head_of_puskesmas') is-invalid @enderror"
                                    name="head_of_puskesmas" id="head_of_puskesmas"
                                    value="{{ old('head_of_puskesmas', Auth::user()->head_of_puskesmas) }}" required>
                                @error('head_of_puskesmas')
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label form-label-bold" for="head_of_puskesmas_nip">NIP</label>
                                <input type="text" class="form-control @error('head_of_puskesmas_nip') is-invalid @enderror"
                                    name="head_of_puskesmas_nip" id="head_of_puskesmas_nip"
                                    value="{{ old('head_of_puskesmas_nip', Auth::user()->head_of_puskesmas_nip) }}" required>
                                @error('head_of_puskesmas_nip')
                                    <div class="form-text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endrole
                <button type="submit" class="btn-custom btn-submit mt-3">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
