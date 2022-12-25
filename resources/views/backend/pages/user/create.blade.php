@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="name">Nama Pengguna</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') }}" required>
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
                                name="puskesmas_code" id="puskesmas_code" value="{{ old('puskesmas_code') }}">
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
                                id="email" value="{{ old('email') }}" required>
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
                                <option hidden>--Pilih role--</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if (old('role') == $role->name) selected @endif>
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
                    <i class="fas fa-plus"></i>
                    Tambah User
                </button>
            </form>

        </div>
    </div>
@endsection
