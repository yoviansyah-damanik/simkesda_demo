@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="sticky-side content">
            <div class="d-lg-flex justify-content-between align-items-start">
                <div class="d-block">
                    <div class="d-lg-flex justify-content-start">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="kode_nama_puskesmas" class="form-label form-label-bold">
                                    Kode dan Nama Puskesmas
                                </label>
                                <input type="text" class="form-control" id="sumber_data" name="sumber_data"
                                    value="{{ $data->user->puskesmas_code . '-' . $data->user->name }}" required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tahun" class="form-label form-label-bold">
                                    Tahun Profil
                                </label>
                                <input type="text" class="form-control" value="{{ $data->tahun }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                @role('Puskesmas')
                    <div class="text-center mt-3 mt-lg-0">
                        <div class="btn-group mt-1 mt-sm-0">
                            <a class="btn-custom btn-edit" href="{{ route('dashboard.puskesmas.edit', $data->slug) }}">
                                <i class="fas fa-pen"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                @endrole
            </div>
        </div>

        @include('backend.partials.field_data.profil_puskesmas')
    </div>
@endsection
