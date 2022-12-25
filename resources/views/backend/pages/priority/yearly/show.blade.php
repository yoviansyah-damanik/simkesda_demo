@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="sticky-side content">
            <div class="d-lg-flex justify-content-between align-items-start">
                <div class="d-block">
                    <div class="d-lg-flex justify-content-start">
                        <div class="me-lg-2 me-0 col-lg-8">
                            <div class="form-group">
                                <label for="sumber_data" class="form-label form-label-bold">
                                    Sumber Data
                                    <p class="small helper">
                                        Sumber Template Prioritas - Data Tahunan diperoleh.
                                    </p>
                                </label>
                                <input type="text" class="form-control" id="sumber_data" name="sumber_data"
                                    value="{{ old('sumber_data', $data->user->puskesmas_code . '-' . $data->user->name) }}"
                                    required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tahun" class="form-label form-label-bold">
                                    Tahun
                                    <p class="small helper">
                                        Tahun data tahunan.
                                    </p>
                                </label>
                                <input type="text" class="form-control" id="tahun" value="{{ $data->tahun }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-4 text-center text-md-start">
                            @if ($data->status_verifikasi == 0)
                                <span class="badge bg-warning">
                                    Draft
                                </span>
                            @elseif ($data->status_verifikasi == 1)
                                <span class="badge bg-info">
                                    Proses Pemeriksaan
                                </span>
                            @elseif ($data->status_verifikasi == 2)
                                <span class="badge bg-success">
                                    Verifikasi
                                </span>
                                <p class="m-0 mt-2">
                                    <small>
                                        <em>Diverifikasi oleh:</em> <strong>{{ $data->verifikator->name }}</strong>
                                    </small>
                                </p>
                            @else
                                <span class="badge bg-danger">
                                    Periksa Kembali
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 mt-lg-0">
                    @role('Superadmin|Administrator')
                        @if ($data->status_verifikasi == 2 || $data->status_verifikasi == 3)
                            <div class="btn-group mt-1 mt-sm-0">
                                <form action="{{ route('dashboard.priority.yearly.approval', $data->slug) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="stat" id="stat" value="1">
                                    <button type="submit" class="btn-custom btn-submit ms-2">
                                        <i class="fas fa-times"></i>
                                        Batalkan Verifikasi
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="btn-group mt-1 mt-sm-0">
                                <form action="{{ route('dashboard.priority.yearly.approval', $data->slug) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="stat" id="stat" value="2">
                                    <button type="submit" class="btn-custom btn-verified">
                                        <i class="fas fa-check"></i>
                                        Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.priority.yearly.approval', $data->slug) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="stat" id="stat" value="3">
                                    <button type="submit" class="btn-custom btn-submit ms-2">
                                        <i class="fas fa-repeat"></i>
                                        Pengecekan Kembali
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        @role('Puskesmas')
                            @if ($data->status_verifikasi == 0 || $data->status_verifikasi == 3)
                                <div class="btn-group mt-1 mt-sm-0">
                                    <a class="btn-custom btn-edit"
                                        href="{{ route('dashboard.priority.yearly.edit', $data->slug) }}">
                                        <i class="fas fa-pen"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('dashboard.priority.yearly.submission', $data->slug) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button class="btn-custom btn-submit ms-2">
                                            <i class="fas fa-upload"></i>
                                            Ajukan
                                        </button>
                                    </form>
                                </div>
                            @elseif($data->status_verifikasi == 1)
                                <div class="btn-group mt-1 mt-sm-0">
                                    <form action="{{ route('dashboard.priority.yearly.submission', $data->slug) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button class="btn-custom btn-submit ms-2">
                                            <i class="fas fa-times"></i>
                                            Batalkan Pengajuan
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endrole
                    @endrole
                </div>
            </div>
        </div>

        @include('backend.partials.field_data.riwayat_data')
        @include('backend.partials.field_data.prioritas_data_tahunan')
    </div>
@endsection
