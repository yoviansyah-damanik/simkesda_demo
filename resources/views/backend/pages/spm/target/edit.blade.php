@extends('backend.layouts.main')

@section('container')

    <div class="container">
        @include('backend.partials.breadcrumb')

        <form action="" method="post">
            @csrf
            @method('put')
            <div class="sticky-side content">
                <div class="d-lg-flex justify-content-between align-items-start">
                    <div class="col-lg-6 d-flex flex-column">
                        <div class="d-lg-flex justify-content-start">
                            <div class="me-lg-2 me-0 col-md-8">
                                <div class="form-group">
                                    <label for="sumber_data" class="form-label form-label-bold">
                                        Sumber Data
                                        <p class="small helper">
                                            Sumber SPM - Data Sasaran diperoleh.
                                        </p>
                                    </label>
                                    <input type="text" class="form-control" id="sumber_data" name="sumber_data"
                                        value="{{ Auth::user()->puskesmas_code . '-' . Auth::user()->name }}" required
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="tahun" class="form-label form-label-bold">
                                        Tahun
                                        <p class="small helper">
                                            Harap tentukan tahun data
                                        </p>
                                    </label>
                                    <select name="tahun" id="tahun"
                                        class="form-select @error('tahun') is-invalid @enderror" required>
                                        <option value="" hidden>--Pilih tahun--</option>
                                        @for ($th = date('Y'); $th >= 2017; $th--)
                                            <option value="{{ $th }}"
                                                @if (old('tahun', $data->tahun) == $th) selected @endif>
                                                {{ $th }}
                                            </option>
                                        @endfor
                                    </select>
                                    {{-- <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                        id="tahun" name="tahun" placeholder="" value="{{ old('tahun', $data->tahun) }}"
                                        required> --}}
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
                                @else
                                    <span class="badge bg-danger">
                                        Periksa Kembali
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end mt-3 mt-lg-0">
                        @if ($errors->any())
                            <div class="btn-group" role="group">
                                <button id="errorGroup" type="button" class="btn-custom btn-error dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-rectangle-xmark"></i>
                                    Error
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="errorGroup">
                                    @foreach ($errors->getMessages() as $key => $error)
                                        <li class="dropdown-item">
                                            <span class="targetForm" data-target="#{{ $key }}">
                                                {{ $error[0] }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="btn-group">
                            <button type="submit" class="btn-custom btn-submit">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scrollable-side">
                <div class="content">
                    <h2 class="main-title">Data Sasaran</h2>
                    @for ($x = 0; $x < count($att); $x++)
                        <h4 class="content-title mb-0 @if ($x > 0) mt-3 @endif">{{ $att[$x]['label'] }}
                        </h4>

                        <div class="row border-bottom py-2">
                            <label for="{{ $att[$x]['attribute'] }}" class="col-md-6 col-lg-8 form-label text-start">
                                {{ $att[$x]['title'] }}
                            </label>
                            <div class="col-md-6 col-lg-4 mt-2 mt-lg-0 d-flex">
                                <input type="number"
                                    class="form-control @error($att[$x]['attribute']) is-invalid @enderror"
                                    id="{{ $att[$x]['attribute'] }}" name="{{ $att[$x]['attribute'] }}"
                                    value="{{ old($att[$x]['attribute'], $data->{$att[$x]['attribute']}) }}" required>
                                <select class="form-select ms-1" name="{{ $att[$x]['satuan'] }}"
                                    id="{{ $att[$x]['satuan'] }}" required>
                                    <option value="" hidden>--Pilih--</option>
                                    {{ $att[$x]['satuan'] }}
                                    @foreach ($att[$x]['select'] as $val)
                                        <option value="{{ $val }}"
                                            @if (old($att[$x]['satuan'], $data->{$att[$x]['satuan']}) == $val) selected @endif>
                                            {{ $val }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="label">
                                    {{ $att[$x]['symbol'] }}
                                </span>
                            </div>
                        </div>
                    @endfor

                </div>
            </div>
        </form>
    </div>

@endsection
