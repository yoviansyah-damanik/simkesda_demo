@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <h4 class="content-title">Parameter Laporan</h4>

            <form action="{{ route('dashboard.spm.report.user') }}" method="post" class="laporan">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="spm" class="form-label form-label-bold">
                                Template Prioritas
                                <p class="small helper">
                                    Harap tentukan data template prioritas
                                </p>
                            </label>
                            <select name="spm" id="spm" class="form-select" required>
                                <option value="" hidden>--Pilih SPM--</option>
                                <option value="data_sasaran" @if (old('spm') == 'data_sasaran') selected @endif>Data Sasaran
                                </option>
                                <option value="data_tahunan" @if (old('spm') == 'data_tahunan') selected @endif>Data Tahunan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tahun" class="form-label form-label-bold">
                                Tahun
                                <p class="small helper">
                                    Harap tentukan tahun data
                                </p>
                            </label>
                            <select name="tahun" id="tahun" class="form-select" required>
                                <option value="" hidden>--Pilih tahun--</option>
                                {{-- <option value="semua_tahun" @if (old('tahun') == 'semua_tahun') selected @endif>Semua tahun</option> --}}
                                @for ($th = date('Y'); $th >= 2017; $th--)
                                    <option value="{{ $th }}" @if (old('tahun') == $th) selected @endif>
                                        {{ $th }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    {{-- <button type="button" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Lihat Laporan
                    </button> --}}
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i>
                        Unduh PDF
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
