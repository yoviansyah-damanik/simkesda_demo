@extends('backend.layouts.main')

@section('container')

    <div class="container">
        @include('backend.partials.breadcrumb')

        <form action="" method="post">
            @csrf
            <div class="sticky-side content">
                <div class="d-lg-flex justify-content-between align-items-start">
                    <div class="col-lg-6 d-lg-flex justify-content-end">
                        <div class="me-lg-2 me-0 col-lg-8">
                            <div class="form-group">
                                <label for="sumber_data" class="form-label form-label-bold">
                                    Sumber Data
                                    <p class="small helper">
                                        Sumber Template Prioritas - Data Tahunan diperoleh.
                                    </p>
                                </label>
                                <input type="text" class="form-control" id="sumber_data" name="sumber_data"
                                    value="{{ Auth::user()->puskesmas_code . '-' . Auth::user()->name }}" required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tahun" class="form-label form-label-bold">
                                    Tahun
                                    <p class="small helper">
                                        Harap tentukan tahun data.
                                    </p>
                                </label>
                                <select name="tahun" id="tahun"
                                    class="form-select @error('tahun') is-invalid @enderror" required>
                                    <option value="" hidden>--Pilih tahun--</option>
                                    @for ($th = date('Y'); $th >= 2017; $th--)
                                        <option value="{{ $th }}"
                                            @if (old('tahun') == $th) selected @endif>
                                            {{ $th }}
                                        </option>
                                    @endfor
                                </select>
                                {{-- <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun"
                                    name="tahun" placeholder="" value="{{ old('tahun') }}" required> --}}
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
                    <h2 class="main-title">Data Tahunan</h2>

                    @for ($z = 1; $z <= count($label); $z++)
                        <h4 class="content-title @if ($z > 1) mt-5 @endif">{{ $label[$z - 1] }}</h4>

                        @for ($x = 0; $x < count(${'atts_' . $z}); $x++)
                            <div class="row border-bottom py-2">
                                <label for="{{ ${'atts_' . $z}[$x]['attribute'] }}"
                                    class="col-md-6 col-lg-8 form-label text-start">
                                    {{ ${'atts_' . $z}[$x]['title'] }}
                                </label>
                                <div class="col-md-6 col-lg-4 mt-2 mt-lg-0 d-flex">
                                    <input type="number"
                                        class="form-control @error(${'atts_' . $z}[$x]['attribute']) is-invalid @enderror"
                                        id="{{ ${'atts_' . $z}[$x]['attribute'] }}"
                                        name="{{ ${'atts_' . $z}[$x]['attribute'] }}"
                                        value="{{ old(${'atts_' . $z}[$x]['attribute'], 1) }}" required>
                                    <select class="form-select ms-1" name="{{ ${'atts_' . $z}[$x]['satuan'] }}"
                                        id="{{ ${'atts_' . $z}[$x]['satuan'] }}" required>
                                        <option value="" hidden>--Pilih--</option>
                                        {{ ${'atts_' . $z}[$x]['satuan'] }}
                                        @foreach (${'atts_' . $z}[$x]['select'] as $val)
                                            {{-- <option value="{{ $val }}" @if (old(${'atts_' . $z}[$x]['satuan']) == $val) selected @endif>
                                                {{ $val }}
                                            </option> --}}
                                            <option value="{{ $val }}" selected>
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="label">
                                        {{ ${'atts_' . $z}[$x]['symbol'] }}
                                    </span>
                                </div>
                            </div>
                        @endfor
                    @endfor

                </div>
            </div>

        </form>
    </div>

@endsection
