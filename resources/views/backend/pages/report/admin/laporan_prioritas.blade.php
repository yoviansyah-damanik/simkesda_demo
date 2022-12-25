@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <h4 class="content-title">Parameter Laporan</h4>

            <form action="{{ route('dashboard.priority.report.admin') }}" method="post" class="laporan">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="user" class="form-label form-label-bold">
                                Puskesmas
                                <p class="small helper">
                                    Harap pilih puskesmas.
                                </p>
                            </label>
                            <select name="user" id="user" class="form-select selectpicker" required>
                                <option value="" hidden>--Pilih Puskesmas--</option>
                                <option value="semua_puskesmas" @if (old('user') == 'semua_puskesmas') selected @endif>SEMUA
                                    PUSKESMAS</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="template_prioritas" class="form-label form-label-bold">
                                Template Prioritas
                                <p class="small helper">
                                    Harap tentukan data template prioritas
                                </p>
                            </label>
                            <select name="template_prioritas" id="template_prioritas" class="form-select" required>
                                <option value="" hidden>--Pilih Template Prioritas--</option>
                                <option value="data_sasaran" @if (old('template_prioritas') == 'data_sasaran') selected @endif>Data Sasaran
                                </option>
                                <option value="data_bulanan" @if (old('template_prioritas') == 'data_bulanan') selected @endif>Data Bulanan
                                </option>
                                <option value="data_tahunan" @if (old('template_prioritas') == 'data_tahunan') selected @endif>Data Tahunan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="bulan" class="form-label form-label-bold">
                                Bulan
                                <p class="small helper">
                                    Harap tentukan bulan data.
                                </p>
                            </label>
                            <select name="bulan" id="bulan" class="form-select"
                                @if (old('template_prioritas') != 'data_bulanan') disabled @endif required>
                                <option value="" hidden>--Pilih bulan--</option>
                                <option value="semua_bulan" @if (old('bulan') == 'semua_bulan') selected @endif>Semua Bulan
                                </option>
                                {{-- <option value="semua_bulan" @if (old('bulan') == 'semua_bulan') selected @endif>Semua bulan</option> --}}
                                @for ($x = 1; $x <= 12; $x++)
                                    <option value="{{ $x }}" @if (old('bulan') == $x) selected @endif>
                                        {{ Carbon\Carbon::parse(date('Y') . '-' . $x . '-' . date('d'))->translatedFormat('F') }}
                                    </option>
                                @endfor
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
