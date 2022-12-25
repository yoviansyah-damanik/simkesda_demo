@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <h4 class="content-title">Kepala Dinas</h4>
            <form action="" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="name">Nama Kepala Dinas</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name', $data['name']) }}" required>
                            @error('name')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label form-label-bold" for="nip">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                id="nip" value="{{ old('nip', $data['nip']) }}" required>
                            @error('nip')
                                <div class="form-text text-danger">
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
