@extends('backend.layouts.main')

@section('container')

    <div class="container">
        @include('backend.partials.breadcrumb')

        <form action="" method="post">
            @csrf
            <div class="sticky-side content">
                <div class="d-lg-flex justify-content-between align-items-start">
                    <div class="d-lg-flex justify-content-start">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="kode_nama_puskesmas" class="form-label form-label-bold">
                                    Kode dan Nama Puskesmas
                                    <p class="small helper">
                                        Berikut adalah kode dan nama puskesmas yang dipilih
                                    </p>
                                </label>
                                <input type="text"
                                    class="form-control @error('kode_nama_puskesmas') is-invalid @enderror"
                                    id="kode_nama_puskesmas" name="kode_nama_puskesmas" placeholder=""
                                    value="{{ old('kode_nama_puskesmas', Auth::user()->puskesmas_code . '-' . Auth::user()->name) }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tahun" class="form-label form-label-bold">
                                    Tahun Profil
                                    <p class="small helper">
                                        Tahun profil puskesmas
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
                    <div class="text-center mt-3 mt-lg-0">
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
                        <div class="btn-group @if ($errors->any()) mt-1 mt-sm-0 @endif" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn-custom btn-next dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-search"></i>
                                Cari
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li class="dropdown-item">
                                    <a href="#identitas">
                                        1. Identitas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#karakteristik-puskesmas">
                                        2. Karakteristik Puskesmas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#kondisi-puskesmas">
                                        3. Kondisi Puskesmas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#ketenagaan-puskesmas">
                                        4. Ketenagaan Puskesmas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#kendaraan-puskesmas">
                                        5. Kondisi Kendaraan Dinas Puskesmas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#jaringan-puskesmas">
                                        6. Jaringan Puskesmas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#ukbm">
                                        7. UKBM
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#sarana-puskesmas">
                                        8. Sarana Puskesmas
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#pengolah-data">
                                        9. Pengolah Data
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                    {{-- 1. IDENTITAS --}}
                    <div class="row">
                        <span class="scroll" id="identitas">&nbsp;</span>
                        <h2 class="main-title">1. Identitas</h2>
                        {{-- UMUM --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Umum</h4>
                            <div class="form-group">
                                <label for="nama_puskesmas" class="form-label form-label-bold">
                                    Nama Puskesmas
                                    <p class="small helper">
                                        Harap masukkan nama puskesmas dengan jelas.
                                    </p>
                                </label>
                                <input type="text" class="form-control @error('nama_puskesmas') is-invalid @enderror"
                                    id="nama_puskesmas" name="nama_puskesmas"
                                    value="{{ old('nama_puskesmas', Auth::user()->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_puskesmas" class="form-label form-label-bold">
                                    Jenis Puskesmas
                                    <p class="small helper">
                                        Silahkan pilih jenis puskesmas.
                                    </p>
                                </label>
                                <select name="jenis_puskesmas" id="jenis_puskesmas"
                                    class="form-control select2 @error('jenis_puskesmas') is-invalid @enderror" required>
                                    <option value="" disabled selected>--Pilih Jenis Puskesmas--</option>
                                    @foreach ($jenis_puskesmas as $val)
                                        <option value="{{ $val }}"
                                            @if ($val == old('jenis_puskesmas')) selected @endif>
                                            {{ $val }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- WILAYAH DOMISILI --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Wilayah Domisili</h4>
                            <div class="form-group">
                                <label for="id_provinsi" class="form-label form-label-bold">
                                    Provinsi
                                    <p class="small helper">
                                        Silahkan pilih Provinsi.
                                    </p>
                                </label>
                                <input type="text" name="nama_provinsi" id="nama_provinsi"
                                    value="{{ old('nama_provinsi') }}">
                                <select name="id_provinsi" id="id_provinsi"
                                    class="form-control select2 @error('id_provinsi') is-invalid @enderror" required>
                                    @if (old('id_provinsi'))
                                        <option value="{{ old('id_provinsi') }}">
                                            {{ old('nama_provinsi') }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_kabupaten" class="form-label form-label-bold">
                                    Kabupaten/Kota
                                    <p class="small helper">
                                        Silahkan pilih Kabupaten/Kota.
                                    </p>
                                </label>
                                <input type="text" name="nama_kabupaten" id="nama_kabupaten"
                                    value="{{ old('nama_kabupaten') }}">
                                <select name="id_kabupaten" id="id_kabupaten"
                                    class="form-control select2 @error('id_kabupaten') is-invalid @enderror" required>
                                    @if (old('id_kabupaten'))
                                        <option value="{{ old('id_kabupaten') }}">
                                            {{ old('nama_kabupaten') }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_kecamatan" class="form-label form-label-bold">
                                    Kecamatan
                                    <p class="small helper">
                                        Silahkan pilih Kecamatan.
                                    </p>
                                </label>
                                <input type="text" name="nama_kecamatan" id="nama_kecamatan"
                                    value="{{ old('nama_kecamatan') }}">
                                <select name="id_kecamatan" id="id_kecamatan"
                                    class="form-control select2 @error('id_kecamatan') is-invalid @enderror" required>
                                    @if (old('id_kecamatan'))
                                        <option value="{{ old('id_kecamatan') }}">
                                            {{ old('nama_kecamatan') }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_desa" class="form-label form-label-bold">
                                    Desa/Kelurahan
                                    <p class="small helper">
                                        Silahkan pilih Desa/Kelurahan.
                                    </p>
                                </label>
                                <input type="text" name="nama_desa" id="nama_desa" value="{{ old('nama_desa') }}">
                                <select name="id_desa" id="id_desa"
                                    class="form-control select2 @error('id_desa') is-invalid @enderror" required>
                                    @if (old('id_desa'))
                                        <option value="{{ old('id_desa') }}">
                                            {{ old('nama_desa') }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat_puskesmas" class="form-label form-label-bold">
                                    Alamat Puskesmas
                                    <p class="small helper">
                                        Harap masukkan alamat lengkap domisili puskesmas.
                                    </p>
                                </label>
                                <textarea class="form-control @error('alamat_puskesmas') is-invalid @enderror" id="alamat_puskesmas"
                                    name="alamat_puskesmas" required>{{ old('alamat_puskesmas') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos" class="form-label form-label-bold mb-0">
                                    Kode Pos
                                </label>
                                <input type="number" class="form-control @error('kode_pos') is-invalid @enderror"
                                    id="kode_pos" name="kode_pos" placeholder="" value="{{ old('kode_pos') }}"
                                    required>
                            </div>
                        </div>
                        {{-- INFORMASI MEDIA KOMUNIKASI --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Informasi Media Komunikasi</h4>

                            <div class="form-group">
                                <label for="nomor_telp" class="form-label form-label-bold">
                                    Nomor Telpon
                                    <p class="small helper">
                                        Harap masukkan nomor telpon puskesmas.
                                    </p>
                                </label>
                                <input type="number" name="nomor_telp" id="nomor_telp"
                                    class="form-control @error('nomor_telp') is-invalid @enderror"
                                    value="{{ old('nomor_telp') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_fax" class="form-label form-label-bold">
                                    Nomor Fax <span class="small fw-light text-danger">(kosongkan jika tidak ada)</span>
                                    <p class="small helper">
                                        Harap masukkan nomor fax puskesmas.
                                    </p>
                                </label>
                                <input type="text" name="nomor_fax" id="nomor_fax"
                                    class="form-control @error('nomor_fax') is-invalid @enderror"
                                    value="{{ old('nomor_fax') }}">
                            </div>
                            <div class="form-group">
                                <label for="email_puskesmas" class="form-label form-label-bold">
                                    Email
                                    <p class="small helper">
                                        Harap masukkan alamat email puskesmas.
                                    </p>
                                </label>
                                <input type="email" name="email_puskesmas" id="email_puskesmas"
                                    class="form-control @error('email_puskesmas') is-invalid @enderror"
                                    value="{{ old('email_puskesmas') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_kontak" class="form-label form-label-bold">
                                    Nama Kontak
                                    <p class="small helper">
                                        Nama kontak atau pihak penanggung jawab puskesmas.
                                    </p>
                                </label>
                                <input type="text" name="nama_kontak" id="nama_kontak"
                                    class="form-control @error('nama_kontak') is-invalid @enderror"
                                    value="{{ old('nama_kontak') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="telp_kontak" class="form-label form-label-bold">
                                    Nomor Kontak
                                    <p class="small helper">
                                        Harap masukkan nomor telpon dari nama kontak.
                                    </p>
                                </label>
                                <input type="number" name="telp_kontak" id="telp_kontak"
                                    class="form-control @error('telp_kontak') is-invalid @enderror"
                                    value="{{ old('telp_kontak') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email_kontak" class="form-label form-label-bold">
                                    Email
                                    <p class="small helper">
                                        Harap masukkan alamat email dari nama kontak.
                                    </p>
                                </label>
                                <input type="email" name="email_kontak" id="email_kontak"
                                    class="form-control @error('email_kontak') is-invalid @enderror"
                                    value="{{ old('email_kontak') }}" required>
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- 2. KARAKTERISTIK --}}
                    <div class="row">
                        <span class="scroll" id="karakteristik-puskesmas">&nbsp;</span>
                        <h2 class="main-title">2. Karakteristik Puskesmas</h2>

                        {{-- WILAYAH KERJA --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Wilayah Kerja</h4>

                            <div class="row mb-3">
                                <label for="luas_wilayah" class="col-9 form-label form-label-bold text-end">
                                    Luas Wilayah (km<sup>2</sup>)
                                </label>
                                <div class="col-3">
                                    <input type="number" step="0.01"
                                        class="form-control @error('luas_wilayah') is-invalid @enderror"
                                        id="luas_wilayah" name="luas_wilayah" value="{{ old('luas_wilayah') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_desa" class="col-9 form-label form-label-bold text-end">
                                    Jumlah Desa
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_desa') is-invalid @enderror"
                                        id="jml_desa" name="jml_desa" value="{{ old('jml_desa') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_kk" class="col-9 form-label form-label-bold text-end">
                                    Jumlah KK
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_kk') is-invalid @enderror"
                                        id="jml_kk" name="jml_kk" value="{{ old('jml_kk') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_penduduk" class="col-9 form-label form-label-bold text-end">
                                    Jumlah Penduduk (jiwa)
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_penduduk') is-invalid @enderror"
                                        id="jml_penduduk" name="jml_penduduk" value="{{ old('jml_penduduk') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        {{-- POSISI KOORDINAT MAP --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Posisi Latitude Longitude</h4>

                            <div class="form-group">
                                <label for="latitude" class="form-label form-label-bold">
                                    Latitude
                                    <p class="small helper">
                                        Contoh penulisan: Lintang selatan = -5.67890, Lintang utara 1.23456
                                    </p>
                                </label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    id="latitude" name="latitude" placeholder="" value="{{ old('latitude') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="longitude" class="form-label form-label-bold">
                                    Longitude
                                    <p class="small helper">
                                        Contoh penulisan: Bujur timur = 1.12345
                                    </p>
                                </label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                    id="longitude" name="longitude" placeholder="" value="{{ old('longitude') }}"
                                    required>
                            </div>
                        </div>
                        {{-- KRITERIA PUSKESMAS --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Kriteria Puskesmas</h4>
                            <input type="text" id="kriteria_puskesmas">
                            @foreach ($kriteria_puskesmas as $val)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kriteria_puskesmas"
                                        id="kriteria_puskesmas_{{ $loop->iteration }}" value="{{ $val }}"
                                        @if (old('kriteria_puskesmas') == $val) checked @endif required>
                                    <label class="form-check-label" for="kriteria_puskesmas_{{ $loop->iteration }}">
                                        {{ $val }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>

                    {{-- 3. KONDISI PUSKESMAS --}}
                    <div class="row">
                        <span class="scroll" id="kondisi-puskesmas">&nbsp;</span>
                        <h2 class="main-title">3. Kondisi Puskesmas</h2>

                        {{-- KONDISI BANGUNAN --}}
                        <div class="col-lg-6 devide-right">
                            <div class="form-group">
                                <label for="keadaan_bangunan" class="form-label form-label-bold">
                                    Keadaan Bangunan Puskesmas
                                    <p class="small helper">
                                        Harap identifikasi keadaan bangunan puskesmas anda
                                    </p>
                                </label>
                                <select name="keadaan_bangunan" id="keadaan_bangunan" class="form-control select2"
                                    required>
                                    <option value="" disabled selected>--Pilih Keadaan Bangunan--</option>
                                    @foreach ($keadaan_bangunan as $val)
                                        @if ($val == old('keadaan_bangunan'))
                                            <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- STATUS AKREDITASI --}}
                        <div class="col-lg-6 mt-4 mt-lg-0">
                            <div class="form-group">
                                <label for="status_akreditasi" class="form-label form-label-bold">
                                    Status Akreditasi
                                    <p class="small helper">
                                        Harap identifikasi status akreditasi puskesmas anda
                                    </p>
                                </label>
                                <select name="status_akreditasi" id="status_akreditasi" class="form-control select2"
                                    required>
                                    <option value="" disabled selected>--Pilih Status Akreditasi--</option>
                                    @foreach ($akreditasi as $val)
                                        @if ($val == old('status_akreditasi'))
                                            <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- 4. KETENAGAAN PUSKESMAS --}}
                    <div class="row">
                        <span class="scroll" id="ketenagaan-puskesmas">&nbsp;</span>
                        <h2 class="main-title">4. Ketenagaan Puskesmas</h2>

                        {{-- TENAGA KESEHATAN --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Jumlah Tenaga Kesehatan</h4>

                            <div class="row mb-3">
                                <label for="jml_dk" class="col-9 form-label form-label-bold text-end">
                                    Dokter
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_dk') is-invalid @enderror"
                                        id="jml_dk" name="jml_dk" value="{{ old('jml_dk') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_dk_gigi" class="col-9 form-label form-label-bold text-end">
                                    Dokter Gigi
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_dk_gigi') is-invalid @enderror"
                                        id="jml_dk_gigi" name="jml_dk_gigi" value="{{ old('jml_dk_gigi') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_perawat" class="col-9 form-label form-label-bold text-end">
                                    Perawat
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_perawat') is-invalid @enderror"
                                        id="jml_perawat" name="jml_perawat" value="{{ old('jml_perawat') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_bidan" class="col-9 form-label form-label-bold text-end">
                                    Bidan
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_bidan') is-invalid @enderror"
                                        id="jml_bidan" name="jml_bidan" value="{{ old('jml_bidan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_tk_masyarakat" class="col-9 form-label form-label-bold text-end">
                                    Tenaga Kesehatan Masyarakat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tk_masyarakat') is-invalid @enderror"
                                        id="jml_tk_masyarakat" name="jml_tk_masyarakat"
                                        value="{{ old('jml_tk_masyarakat') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_tk_lingkungan" class="col-9 form-label form-label-bold text-end">
                                    Tenaga Kesehatan Lingkungan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tk_lingkungan') is-invalid @enderror"
                                        id="jml_tk_lingkungan" name="jml_tk_lingkungan"
                                        value="{{ old('jml_tk_lingkungan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_tenaga_gizi" class="col-9 form-label form-label-bold text-end">
                                    Tenaga Gizi
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tenaga_gizi') is-invalid @enderror"
                                        id="jml_tenaga_gizi" name="jml_tenaga_gizi" value="{{ old('jml_tenaga_gizi') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_ahli_tek_medik" class="col-9 form-label form-label-bold text-end">
                                    Ahli Teknologi Medik
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_ahli_tek_medik') is-invalid @enderror"
                                        id="jml_ahli_tek_medik" name="jml_ahli_tek_medik"
                                        value="{{ old('jml_ahli_tek_medik') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_farmasi" class="col-9 form-label form-label-bold text-end">
                                    Farmasi
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_farmasi') is-invalid @enderror"
                                        id="jml_farmasi" name="jml_farmasi" value="{{ old('jml_farmasi') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_tenaga_kesehatan" class="col-9 form-label form-label-bold text-end">
                                    Total Tenaga Kesehatan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tenaga_kesehatan') is-invalid @enderror"
                                        id="jml_tenaga_kesehatan" name="jml_tenaga_kesehatan"
                                        value="{{ old('jml_tenaga_kesehatan') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- TENAGA PENDUKUNG --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Jumlah Tenaga Pendukung</h4>

                            <div class="row mb-3">
                                <label for="jml_tenaga_penunjang" class="col-9 form-label form-label-bold text-end">
                                    Tenaga Penunjang
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tenaga_penunjang') is-invalid @enderror"
                                        id="jml_tenaga_penunjang" name="jml_tenaga_penunjang"
                                        value="{{ old('jml_tenaga_penunjang') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- TENAGA PUSKESMAS --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Total Tenaga Puskesmas</h4>

                            <div class="row mb-3">
                                <label for="jml_tenaga_puskesmas" class="col-9 form-label form-label-bold text-end">
                                    Tenaga Tenaga di Puskesmas
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tenaga_puskesmas') is-invalid @enderror"
                                        id="jml_tenaga_puskesmas" name="jml_tenaga_puskesmas"
                                        value="{{ old('jml_tenaga_puskesmas') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- 5. KENDARAAN PUSKESMAS --}}
                    <div class="row">
                        <span class="scroll" id="kendaraan-puskesmas">&nbsp;</span>
                        <h2 class="main-title">5. Kondisi Kendaraan Dinas Puskesmas</h2>

                        {{-- AMBULANCE --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Kendaraan Ambulance</h4>
                            <div class="row mb-3">
                                <label for="ambulance_baik" class="col-9 form-label form-label-bold text-end">
                                    Baik
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('ambulance_baik') is-invalid @enderror"
                                        id="ambulance_baik" name="ambulance_baik" value="{{ old('ambulance_baik') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ambulance_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                                    Rusak Ringan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('ambulance_rusak_ringan') is-invalid @enderror"
                                        id="ambulance_rusak_ringan" name="ambulance_rusak_ringan"
                                        value="{{ old('ambulance_rusak_ringan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ambulance_rusak_berat" class="col-9 form-label form-label-bold text-end">
                                    Rusak Berat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('ambulance_rusak_berat') is-invalid @enderror"
                                        id="ambulance_rusak_berat" name="ambulance_rusak_berat"
                                        value="{{ old('ambulance_rusak_berat') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_ambulance" class="col-9 form-label form-label-bold text-end">
                                    Total Ambulance
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_ambulance') is-invalid @enderror"
                                        id="jml_ambulance" name="jml_ambulance" value="{{ old('jml_ambulance') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- SEPEDA MOTOR --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Kendaraan Sepeda Motor</h4>
                            <div class="row mb-3">
                                <label for="motor_baik" class="col-9 form-label form-label-bold text-end">
                                    Baik
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('motor_baik') is-invalid @enderror"
                                        id="motor_baik" name="motor_baik" value="{{ old('motor_baik') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="motor_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                                    Rusak Ringan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('motor_rusak_ringan') is-invalid @enderror"
                                        id="motor_rusak_ringan" name="motor_rusak_ringan"
                                        value="{{ old('motor_rusak_ringan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="motor_rusak_berat" class="col-9 form-label form-label-bold text-end">
                                    Rusak Berat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('motor_rusak_berat') is-invalid @enderror"
                                        id="motor_rusak_berat" name="motor_rusak_berat"
                                        value="{{ old('motor_rusak_berat') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_motor" class="col-9 form-label form-label-bold text-end">
                                    Total Sepeda Motor
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_motor') is-invalid @enderror"
                                        id="jml_motor" name="jml_motor" value="{{ old('jml_motor') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- PUSLING --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Kendaraan Puskesmas Keliling</h4>
                            <div class="row mb-3">
                                <label for="pusling_baik" class="col-9 form-label form-label-bold text-end">
                                    Baik
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pusling_baik') is-invalid @enderror"
                                        id="pusling_baik" name="pusling_baik" value="{{ old('pusling_baik') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pusling_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                                    Rusak Ringan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pusling_rusak_ringan') is-invalid @enderror"
                                        id="pusling_rusak_ringan" name="pusling_rusak_ringan"
                                        value="{{ old('pusling_rusak_ringan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pusling_rusak_berat" class="col-9 form-label form-label-bold text-end">
                                    Rusak Berat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pusling_rusak_berat') is-invalid @enderror"
                                        id="pusling_rusak_berat" name="pusling_rusak_berat"
                                        value="{{ old('pusling_rusak_berat') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_pusling" class="col-9 form-label form-label-bold text-end">
                                    Total Kendaraan Puskesmas Keliling
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_pusling') is-invalid @enderror"
                                        id="jml_pusling" name="jml_pusling" value="{{ old('jml_pusling') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- PUSLING PERAIRAN --}}
                        <div class="col-lg-4 mt-4">
                            <h4 class="content-title">Kendaraan Pusling Perairan</h4>
                            <div class="row mb-3">
                                <label for="pusling_perairan_baik" class="col-9 form-label form-label-bold text-end">
                                    Baik
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pusling_perairan_baik') is-invalid @enderror"
                                        id="pusling_perairan_baik" name="pusling_perairan_baik"
                                        value="{{ old('pusling_perairan_baik') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pusling_perairan_rusak_ringan"
                                    class="col-9 form-label form-label-bold text-end">
                                    Rusak Ringan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pusling_perairan_rusak_ringan') is-invalid @enderror"
                                        id="pusling_perairan_rusak_ringan" name="pusling_perairan_rusak_ringan"
                                        value="{{ old('pusling_perairan_rusak_ringan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pusling_perairan_rusak_berat"
                                    class="col-9 form-label form-label-bold text-end">
                                    Rusak Berat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pusling_perairan_rusak_berat') is-invalid @enderror"
                                        id="pusling_perairan_rusak_berat" name="pusling_perairan_rusak_berat"
                                        value="{{ old('pusling_perairan_rusak_berat') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_pusling_perairan" class="col-9 form-label form-label-bold text-end">
                                    Total Kendaraan Pusling Perairan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_pusling_perairan') is-invalid @enderror"
                                        id="jml_pusling_perairan" name="jml_pusling_perairan"
                                        value="{{ old('jml_pusling_perairan') }}" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    {{-- 6. JARINGAN PUSKESMAS --}}
                    <div class="row">
                        <span class="scroll" id="jaringan-puskesmas">&nbsp;</span>
                        <h2 class="main-title">6. Jaringan Puskesmas</h2>

                        {{-- PUSTU --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Pustu</h4>
                            <div class="row mb-3">
                                <label for="pustu_baik" class="col-9 form-label form-label-bold text-end">
                                    Baik
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('pustu_baik') is-invalid @enderror"
                                        id="pustu_baik" name="pustu_baik" value="{{ old('pustu_baik') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pustu_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                                    Rusak Ringan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pustu_rusak_ringan') is-invalid @enderror"
                                        id="pustu_rusak_ringan" name="pustu_rusak_ringan"
                                        value="{{ old('pustu_rusak_ringan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pustu_rusak_sedang" class="col-9 form-label form-label-bold text-end">
                                    Rusak Sedang
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pustu_rusak_sedang') is-invalid @enderror"
                                        id="pustu_rusak_sedang" name="pustu_rusak_sedang"
                                        value="{{ old('pustu_rusak_sedang') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pustu_rusak_berat" class="col-9 form-label form-label-bold text-end">
                                    Rusak Berat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('pustu_rusak_berat') is-invalid @enderror"
                                        id="pustu_rusak_berat" name="pustu_rusak_berat"
                                        value="{{ old('pustu_rusak_berat') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_pustu" class="col-9 form-label form-label-bold text-end">
                                    Total Pustu
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_pustu') is-invalid @enderror"
                                        id="jml_pustu" name="jml_pustu" value="{{ old('jml_pustu') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- RUMAH DINAS NAKES --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Rumah Dinas Nakes</h4>
                            <div class="row mb-3">
                                <label for="rumdis_nakes_baik" class="col-9 form-label form-label-bold text-end">
                                    Baik
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('rumdis_nakes_baik') is-invalid @enderror"
                                        id="rumdis_nakes_baik" name="rumdis_nakes_baik"
                                        value="{{ old('rumdis_nakes_baik') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="rumdis_nakes_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                                    Rusak Ringan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('rumdis_nakes_rusak_ringan') is-invalid @enderror"
                                        id="rumdis_nakes_rusak_ringan" name="rumdis_nakes_rusak_ringan"
                                        value="{{ old('rumdis_nakes_rusak_ringan') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="rumdis_nakes_rusak_sedang" class="col-9 form-label form-label-bold text-end">
                                    Rusak Sedang
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('rumdis_nakes_rusak_sedang') is-invalid @enderror"
                                        id="rumdis_nakes_rusak_sedang" name="rumdis_nakes_rusak_sedang"
                                        value="{{ old('rumdis_nakes_rusak_sedang') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="rumdis_nakes_rusak_berat" class="col-9 form-label form-label-bold text-end">
                                    Rusak Berat
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('rumdis_nakes_rusak_berat') is-invalid @enderror"
                                        id="rumdis_nakes_rusak_berat" name="rumdis_nakes_rusak_berat"
                                        value="{{ old('rumdis_nakes_rusak_berat') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_rumdis_nakes" class="col-9 form-label form-label-bold text-end">
                                    Total Rumah Dinas Nakes
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_rumdis_nakes') is-invalid @enderror"
                                        id="jml_rumdis_nakes" name="jml_rumdis_nakes"
                                        value="{{ old('jml_rumdis_nakes') }}" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    {{-- 7. UKBM --}}
                    <div class="row">
                        <span class="scroll" id="ukbm">&nbsp;</span>
                        <h2 class="main-title">7. UKBM</h2>

                        {{-- JUMLAH UKBM --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Jumlah UKBM</h4>
                            <div class="row mb-3">
                                <label for="jml_poskesdes" class="col-9 form-label form-label-bold text-end">
                                    Poskesdes
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_poskesdes') is-invalid @enderror"
                                        id="jml_poskesdes" name="jml_poskesdes" value="{{ old('jml_poskesdes') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_poskestren" class="col-9 form-label form-label-bold text-end">
                                    Poskestren
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_poskestren') is-invalid @enderror"
                                        id="jml_poskestren" name="jml_poskestren" value="{{ old('jml_poskestren') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_posyandu_lansia" class="col-9 form-label form-label-bold text-end">
                                    Posyandu Lansia
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posyandu_lansia') is-invalid @enderror"
                                        id="jml_posyandu_lansia" name="jml_posyandu_lansia"
                                        value="{{ old('jml_posyandu_lansia') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_posbindu_ptm_aktif" class="col-9 form-label form-label-bold text-end">
                                    Posbindu PTM Aktif
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posbindu_ptm_aktif') is-invalid @enderror"
                                        id="jml_posbindu_ptm_aktif" name="jml_posbindu_ptm_aktif"
                                        value="{{ old('jml_posbindu_ptm_aktif') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_ukbm" class="col-9 form-label form-label-bold text-end">
                                    Total UKBM
                                </label>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('jml_ukbm') is-invalid @enderror"
                                        id="jml_ukbm" name="jml_ukbm" value="{{ old('jml_ukbm') }}" required>
                                </div>
                            </div>

                        </div>

                        {{-- JUMLAH POSYANDU --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Jumlah Posyandu</h4>
                            <div class="row mb-3">
                                <label for="jml_posyandu_pratama" class="col-9 form-label form-label-bold text-end">
                                    Posyandu Pratama
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posyandu_pratama') is-invalid @enderror"
                                        id="jml_posyandu_pratama" name="jml_posyandu_pratama"
                                        value="{{ old('jml_posyandu_pratama') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_posyandu_madya" class="col-9 form-label form-label-bold text-end">
                                    Posyandu Madya
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posyandu_madya') is-invalid @enderror"
                                        id="jml_posyandu_madya" name="jml_posyandu_madya"
                                        value="{{ old('jml_posyandu_madya') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_posyandu_purnama" class="col-9 form-label form-label-bold text-end">
                                    Posyandu Purnama
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posyandu_purnama') is-invalid @enderror"
                                        id="jml_posyandu_purnama" name="jml_posyandu_purnama"
                                        value="{{ old('jml_posyandu_purnama') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_posyandu_mandiri" class="col-9 form-label form-label-bold text-end">
                                    Posyandu Mandiri
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posyandu_mandiri') is-invalid @enderror"
                                        id="jml_posyandu_mandiri" name="jml_posyandu_mandiri"
                                        value="{{ old('jml_posyandu_mandiri') }}" required>
                                </div>
                            </div>

                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_posyandu" class="col-9 form-label form-label-bold text-end">
                                    Total Posyandu
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_posyandu') is-invalid @enderror"
                                        id="jml_posyandu" name="jml_posyandu" value="{{ old('jml_posyandu') }}"
                                        required>
                                </div>
                            </div>

                        </div>

                        {{-- JUMLAH UKBM + POSYANDU --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Jumlah UKBM + Posyandu</h4>
                            <div class="row mb-3">
                                <label for="jml_ukbm_posyandu" class="col-9 form-label form-label-bold text-end">
                                    Total UKBM + Posyandu
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_ukbm_posyandu') is-invalid @enderror"
                                        id="jml_ukbm_posyandu" name="jml_ukbm_posyandu"
                                        value="{{ old('jml_ukbm_posyandu') }}" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    {{-- 8. SARANA PUSKESMAS --}}
                    <div class="row">
                        <span class="scroll" id="sarana-puskesmas">&nbsp;</span>
                        <h2 class="main-title">8. Sarana Puskesmas</h2>

                        {{-- TEMPAT TIDUR, SIMPUS, KETERSEDIAAN --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Tempat Tidur</h4>
                            <div class="row mb-3">
                                <label for="jml_tt_perawatan_umum" class="col-9 form-label form-label-bold text-end">
                                    Jumlah TT Perawatan Umum
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tt_perawatan_umum') is-invalid @enderror"
                                        id="jml_tt_perawatan_umum" name="jml_tt_perawatan_umum"
                                        value="{{ old('jml_tt_perawatan_umum') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jml_tt_perawatan_persalinan"
                                    class="col-9 form-label form-label-bold text-end">
                                    Jumlah TT Perawatan Persalinan
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_tt_perawatan_persalinan') is-invalid @enderror"
                                        id="jml_tt_perawatan_persalinan" name="jml_tt_perawatan_persalinan"
                                        value="{{ old('jml_tt_perawatan_persalinan') }}" required>
                                </div>
                            </div>

                            <h4 class="content-title mt-4">SIMPUS</h4>
                            <div class="form-group">
                                <label for="nama_aplikasi_pencatatan" class="form-label form-label-bold">
                                    Nama Aplikasi Pencatatan Puskesmas (25 karakter)
                                    <p class="small helper">
                                        Harap masukkan nama SIMPUS dengan jelas.
                                    </p>
                                </label>
                                <input type="text"
                                    class="form-control @error('nama_aplikasi_pencatatan') is-invalid @enderror"
                                    id="nama_aplikasi_pencatatan" name="nama_aplikasi_pencatatan" placeholder=""
                                    value="{{ old('nama_aplikasi_pencatatan') }}" maxlength="25" required>
                            </div>

                            <h4 class="content-title mt-4">Ketersediaan Lainnya</h4>
                            {{-- Listrik --}}
                            <div class="form-group">
                                <label for="waktu_ketersediaan_listrik" class="form-label form-label-bold">
                                    Waktu Ketersediaan Listrik
                                    <p class="small helper">
                                        Harap identifikasi status ketersediaan listrik puskesmas anda
                                    </p>
                                </label>
                                <select name="waktu_ketersediaan_listrik" id="waktu_ketersediaan_listrik"
                                    class="form-control select2" required>
                                    <option value="" disabled selected>--Pilih Status Ketersediaan Listrik--</option>
                                    @foreach ($waktu_ketersediaan_listrik as $val)
                                        @if ($val == old('waktu_ketersediaan_listrik'))
                                            <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{-- Telepon Kabel --}}
                            <div class="form-group">
                                <label for="telepon_kabel" class="form-label form-label-bold">
                                    Telepon Kabel
                                    <p class="small helper">
                                        Harap identifikasi status telepon kabel puskesmas anda
                                    </p>
                                </label>
                                <select name="telepon_kabel" id="telepon_kabel" class="form-control select2" required>
                                    <option value="" disabled selected>--Pilih Status Telepon Kabel--</option>
                                    @foreach ($telepon_kabel as $val)
                                        @if ($val == old('telepon_kabel'))
                                            <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{-- Radio Komunikasi --}}
                            <div class="form-group">
                                <label for="radio_komunikasi" class="form-label form-label-bold">
                                    Radio Komunikasi
                                    <p class="small helper">
                                        Harap identifikasi radio komunikasi puskesmas anda
                                    </p>
                                </label>
                                <select name="radio_komunikasi" id="radio_komunikasi" class="form-control select2"
                                    required>
                                    <option value="" disabled selected>--Pilih Status Radio Komunikasi--</option>
                                    @foreach ($radio_komunikasi as $val)
                                        @if ($val == old('radio_komunikasi'))
                                            <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{-- Jaringan Internet --}}
                            <div class="form-group">
                                <label for="jaringan_internet" class="form-label form-label-bold">
                                    Jaringan Internet
                                    <p class="small helper">
                                        Harap identifikasi jaringan internet puskesmas anda
                                    </p>
                                </label>
                                <select name="jaringan_internet" id="jaringan_internet" class="form-control select2"
                                    required>
                                    <option value="" disabled selected>--Pilih Status Jaringan Internet--</option>
                                    @foreach ($jaringan_internet as $val)
                                        @if ($val == old('jaringan_internet'))
                                            <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- SUMBER AIR, LISTRIK --}}
                        <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                            <h4 class="content-title">Sumber Air Bersih</h4>
                            <input type="text" id="sumber_air">
                            @foreach ($sumber_air as $val)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sumber_air"
                                        id="sumber_air_{{ $loop->iteration }}" value="{{ $val }}"
                                        @if (old('sumber_air') == $val) checked @endif required>
                                    <label class="form-check-label" for="sumber_air_{{ $loop->iteration }}">
                                        {{ $val }}
                                    </label>
                                </div>
                            @endforeach

                            <h4 class="content-title mt-4">Sumber Listrik</h4>
                            <input type="text" id="sumber_listrik">
                            @foreach ($sumber_listrik as $val)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sumber_listrik"
                                        id="sumber_listrik_{{ $loop->iteration }}" value="{{ $val }}"
                                        @if (old('sumber_listrik') == $val) checked @endif required>
                                    <label class="form-check-label" for="sumber_listrik_{{ $loop->iteration }}">
                                        {{ $val }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- AKSES JALAN, KENDARAAN LEWAT, WAKTU TEMPUH --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Akses Jalan Depan Gedung Puskesmas</h4>
                            <input type="text" id="akses_jalan_depan">
                            @foreach ($akses_jalan_depan as $val)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="akses_jalan_depan"
                                        id="akses_jalan_depan_{{ $loop->iteration }}" value="{{ $val }}"
                                        @if (old('akses_jalan_depan') == $val) checked @endif required>
                                    <label class="form-check-label" for="akses_jalan_depan_{{ $loop->iteration }}">
                                        {{ $val }}
                                    </label>
                                </div>
                            @endforeach

                            <h4 class="content-title mt-4">Kendaraan Yang Dapat Lewat Melalui Jalan Depan Puskesmas</h4>
                            <input type="text" id="kendaraan_lewat">
                            @foreach ($kendaraan_lewat as $val)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kendaraan_lewat"
                                        id="kendaraan_lewat_{{ $loop->iteration }}" value="{{ $val }}"
                                        @if (old('kendaraan_lewat') == $val) checked @endif required>
                                    <label class="form-check-label" for="kendaraan_lewat_{{ $loop->iteration }}">
                                        {{ $val }}
                                    </label>
                                </div>
                            @endforeach

                            <h4 class="content-title mt-4">Waktu Tempuh</h4>
                            <div class="row mb-3">
                                <label for="waktu_tempuh" class="col-9 form-label form-label-bold text-end">
                                    Waktu tempuh terlama bagi warga menuju puskesmas (menit)
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('waktu_tempuh') is-invalid @enderror"
                                        id="waktu_tempuh" name="waktu_tempuh" value="{{ old('waktu_tempuh') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- 9. KONDISI PENGOLAH DATA --}}
                    <div class="row">
                        <span class="scroll" id="pengolah-data">&nbsp;</span>
                        <h2 class="main-title">9. Pengolah Data Puskesmas</h2>

                        {{-- KOMPUTER --}}
                        <div class="col-lg-4 devide-right">
                            <h4 class="content-title">Perangkat Komputer</h4>
                            <div class="row mb-3">
                                <label for="komputer_berfungsi" class="col-9 form-label form-label-bold text-end">
                                    Berfungsi
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('komputer_berfungsi') is-invalid @enderror"
                                        id="komputer_berfungsi" name="komputer_berfungsi"
                                        value="{{ old('komputer_berfungsi') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="komputer_tidak_berfungsi" class="col-9 form-label form-label-bold text-end">
                                    Tidak Berfungsi
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('komputer_tidak_berfungsi') is-invalid @enderror"
                                        id="komputer_tidak_berfungsi" name="komputer_tidak_berfungsi"
                                        value="{{ old('komputer_tidak_berfungsi') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_komputer" class="col-9 form-label form-label-bold text-end">
                                    Jumlah Komputer
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_komputer') is-invalid @enderror"
                                        id="jml_komputer" name="jml_komputer" value="{{ old('jml_komputer') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- LAPTOP --}}
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <h4 class="content-title">Perangkat Laptop</h4>
                            <div class="row mb-3">
                                <label for="laptop_berfungsi" class="col-9 form-label form-label-bold text-end">
                                    Berfungsi
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('laptop_berfungsi') is-invalid @enderror"
                                        id="laptop_berfungsi" name="laptop_berfungsi"
                                        value="{{ old('laptop_berfungsi') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="laptop_tidak_berfungsi" class="col-9 form-label form-label-bold text-end">
                                    Tidak Berfungsi
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('laptop_tidak_berfungsi') is-invalid @enderror"
                                        id="laptop_tidak_berfungsi" name="laptop_tidak_berfungsi"
                                        value="{{ old('laptop_tidak_berfungsi') }}" required>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row mb-3">
                                <label for="jml_laptop" class="col-9 form-label form-label-bold text-end">
                                    Jumlah Laptop
                                </label>
                                <div class="col-3">
                                    <input type="number"
                                        class="form-control @error('jml_laptop') is-invalid @enderror" id="jml_laptop"
                                        name="jml_laptop" value="{{ old('jml_laptop') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
