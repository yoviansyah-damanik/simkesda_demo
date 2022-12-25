<div class="scrollable-side">
    <div class="content">
        {{-- 1. IDENTITAS --}}
        <div class="row" id="identitas">
            <h2 class="main-title">1. Identitas</h2>
            {{-- UMUM --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Umum</h4>
                <div class="form-group">
                    <label for="nama_puskesmas" class="form-label form-label-bold">
                        Nama Puskesmas
                    </label>
                    <input type="text" class="form-control" value="{{ $data->nama_puskesmas }}" readonly>
                </div>
                <div class="form-group">
                    <label for="jenis_puskesmas" class="form-label form-label-bold">
                        Jenis Puskesmas
                    </label>
                    <input type="text" class="form-control" value="{{ $data->jenis_puskesmas }}" readonly>
                </div>
            </div>
            {{-- WILAYAH DOMISILI --}}
            <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                <h4 class="content-title">Wilayah Domisili</h4>

                <div class="form-group">
                    <label for="id_provinsi" class="form-label form-label-bold">
                        Provinsi
                    </label>
                    <input type="text" class="form-control" value="{{ $data->province->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="id_kabupaten" class="form-label form-label-bold">
                        Kabupaten/Kota
                    </label>
                    <input type="text" class="form-control" value="{{ $data->regency->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="id_kecamatan" class="form-label form-label-bold">
                        Kecamatan
                    </label>
                    <input type="text" class="form-control" value="{{ $data->district->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="id_desa" class="form-label form-label-bold">
                        Desa/Kelurahan
                    </label>
                    <input type="text" class="form-control" value="{{ $data->village->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="alamat_puskesmas" class="form-label form-label-bold">
                        Alamat Puskesmas
                    </label>
                    <textarea class="form-control" id="alamat_puskesmas" name="alamat_puskesmas" readonly>{{ $data->alamat_puskesmas }}</textarea>
                </div>
                <div class="form-group">
                    <label for="kode_pos" class="form-label form-label-bold mb-0">
                        Kode Pos
                    </label>
                    <input type="text" class="form-control" value="{{ $data->kode_pos }}" readonly>
                </div>
            </div>
            {{-- INFORMASI MEDIA KOMUNIKASI --}}
            <div class="col-lg-4 mt-4 mt-lg-0">
                <h4 class="content-title">Informasi Media Komunikasi</h4>

                <div class="form-group">
                    <label for="nomor_telp" class="form-label form-label-bold">
                        Nomor Telpon
                    </label>
                    <input type="text" class="form-control" value="{{ $data->nomor_telp }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nomor_fax" class="form-label form-label-bold">
                        Nomor Fax
                    </label>
                    <input type="text" class="form-control" value="{{ $data->nomor_fax ?? '-' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="email_puskesmas" class="form-label form-label-bold">
                        Email
                    </label>
                    <input type="text" class="form-control" value="{{ $data->email_puskesmas }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_kontak" class="form-label form-label-bold">
                        Nama Kontak
                    </label>
                    <input type="text" class="form-control" value="{{ $data->nama_kontak }}" readonly>
                </div>
                <div class="form-group">
                    <label for="telp_kontak" class="form-label form-label-bold">
                        Nomor Kontak
                    </label>
                    <input type="text" class="form-control" value="{{ $data->telp_kontak }}" readonly>
                </div>
                <div class="form-group">
                    <label for="email_kontak" class="form-label form-label-bold">
                        Email
                    </label>
                    <input type="text" class="form-control" value="{{ $data->email_kontak }}" readonly>
                </div>
            </div>
        </div>
        <hr>

        {{-- 2. KARAKTERISTIK --}}
        <div class="row" id="karakteristik-puskesmas">
            <h2 class="main-title">2. Karakteristik Puskesmas</h2>

            {{-- WILAYAH KERJA --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Wilayah Kerja</h4>

                <div class="row mb-3">
                    <label for="luas_wilayah" class="col-9 form-label form-label-bold text-end">
                        Luas Wilayah (km<sup>2</sup>)
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->luas_wilayah)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_desa" class="col-9 form-label form-label-bold text-end">
                        Jumlah Desa
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_desa)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_kk" class="col-9 form-label form-label-bold text-end">
                        Jumlah KK
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_kk)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_penduduk" class="col-9 form-label form-label-bold text-end">
                        Jumlah Penduduk (jiwa)
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_penduduk)" readonly>
                    </div>
                </div>
            </div>
            {{-- POSISI KOORDINAT MAP --}}
            <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                <h4 class="content-title">Posisi Latitude Longitude</h4>

                <div class="form-group">
                    <label for="latitude" class="form-label form-label-bold">
                        Latitude
                    </label>
                    <input type="text" class="form-control" value="{{ $data->latitude }}" readonly>
                </div>
                <div class="form-group">
                    <label for="longitude" class="form-label form-label-bold">
                        Longitude
                    </label>
                    <input type="text" class="form-control" value="{{ $data->longitude }}" readonly>
                </div>
            </div>
            {{-- KRITERIA PUSKESMAS --}}
            <div class="col-lg-4 mt-4 mt-lg-0">
                <h4 class="content-title">Kriteria Puskesmas</h4>
                <input type="text" class="form-control" value="{{ $data->kriteria_puskesmas }}" readonly>
            </div>
        </div>
        <hr>

        {{-- 3. KONDISI PUSKESMAS --}}
        <div class="row" id="kondisi-puskesmas">
            <h2 class="main-title">3. Kondisi Puskesmas</h2>

            {{-- KONDISI BANGUNAN --}}
            <div class="col-lg-6 devide-right">
                <div class="form-group">
                    <label for="keadaan_bangunan" class="form-label form-label-bold">
                        Keadaan Bangunan Puskesmas
                    </label>
                    <input type="text" class="form-control" value="{{ $data->keadaan_bangunan }}" readonly>
                </div>
            </div>

            {{-- STATUS AKREDITASI --}}
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="form-group">
                    <label for="status_akreditasi" class="form-label form-label-bold">
                        Status Akreditasi
                    </label>
                    <input type="text" class="form-control" value="{{ $data->status_akreditasi }}" readonly>
                </div>
            </div>
        </div>
        <hr>

        {{-- 4. KETENAGAAN PUSKESMAS --}}
        <div class="row" id="ketenagaan-puskesmas">
            <h2 class="main-title">4. Ketenagaan Puskesmas</h2>

            {{-- TENAGA KESEHATAN --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Jumlah Tenaga Kesehatan</h4>

                <div class="row mb-3">
                    <label for="jml_dk" class="col-9 form-label form-label-bold text-end">
                        Dokter
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_dk)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_dk_gigi" class="col-9 form-label form-label-bold text-end">
                        Dokter Gigi
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_dk_gigi)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_perawat" class="col-9 form-label form-label-bold text-end">
                        Perawat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_perawat)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_bidan" class="col-9 form-label form-label-bold text-end">
                        Bidan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_bidan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_tk_masyarakat" class="col-9 form-label form-label-bold text-end">
                        Tenaga Kesehatan Masyarakat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_tk_masyarakat)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_tk_lingkungan" class="col-9 form-label form-label-bold text-end">
                        Tenaga Kesehatan Lingkungan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_tk_lingkungan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_tenaga_gizi" class="col-9 form-label form-label-bold text-end">
                        Tenaga Gizi
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_tenaga_gizi)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_ahli_tek_medik" class="col-9 form-label form-label-bold text-end">
                        Ahli Teknologi Medik
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_ahli_tek_medis)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_farmasi" class="col-9 form-label form-label-bold text-end">
                        Farmasi
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_farmasi)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_tenaga_kesehatan" class="col-9 form-label form-label-bold text-end">
                        Total Tenaga Kesehatan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_tenaga_kesehatan)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->jml_tenaga_penunjang)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->jml_tenaga_puskesmas)" readonly>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {{-- 5. KENDARAAN PUSKESMAS --}}
        <div class="row" id="kendaraan-puskesmas">
            <h2 class="main-title">5. Kondisi Kendaraan Dinas Puskesmas</h2>

            {{-- AMBULANCE --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Kendaraan Ambulance</h4>
                <div class="row mb-3">
                    <label for="ambulance_baik" class="col-9 form-label form-label-bold text-end">
                        Baik
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->ambulance_baik)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ambulance_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                        Rusak Ringan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->ambulance_rusak_ringan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ambulance_rusak_berat" class="col-9 form-label form-label-bold text-end">
                        Rusak Berat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->ambulance_rusak_berat)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_ambulance" class="col-9 form-label form-label-bold text-end">
                        Total Ambulance
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_ambulance)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->motor_baik)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="motor_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                        Rusak Ringan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->motor_rusak_ringan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="motor_rusak_berat" class="col-9 form-label form-label-bold text-end">
                        Rusak Berat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->motor_rusak_berat)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_motor" class="col-9 form-label form-label-bold text-end">
                        Total Sepeda Motor
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_motor)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->pusling_baik)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pusling_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                        Rusak Ringan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pusling_rusak_ringan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pusling_rusak_berat" class="col-9 form-label form-label-bold text-end">
                        Rusak Berat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pusling_rusak_berat)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_pusling" class="col-9 form-label form-label-bold text-end">
                        Total Kendaraan Puskesmas Keliling
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_pusling)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->pusling_perairan_baik)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pusling_perairan_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                        Rusak Ringan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pusling_perairan_rusak_ringan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pusling_perairan_rusak_berat" class="col-9 form-label form-label-bold text-end">
                        Rusak Berat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pusling_perairan_rusak_berat)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_pusling_perairan" class="col-9 form-label form-label-bold text-end">
                        Total Kendaraan Pusling Perairan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_pusling_perairan)" readonly>
                    </div>
                </div>
            </div>

        </div>
        <hr>

        {{-- 6. JARINGAN PUSKESMAS --}}
        <div class="row" id="jaringan-puskesmas">
            <h2 class="main-title">6. Jaringan Puskesmas</h2>

            {{-- PUSTU --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Pustu</h4>
                <div class="row mb-3">
                    <label for="pustu_baik" class="col-9 form-label form-label-bold text-end">
                        Baik
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pustu_baik)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pustu_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                        Rusak Ringan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pustu_rusak_ringan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pustu_rusak_sedang" class="col-9 form-label form-label-bold text-end">
                        Rusak Sedang
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pustu_rusak_sedang)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pustu_rusak_berat" class="col-9 form-label form-label-bold text-end">
                        Rusak Berat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->pustu_rusak_berat)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_pustu" class="col-9 form-label form-label-bold text-end">
                        Total Pustu
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_pustu)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->rumdis_nakes_baik)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rumdis_nakes_rusak_ringan" class="col-9 form-label form-label-bold text-end">
                        Rusak Ringan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->rumdis_nakes_rusak_ringan)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rumdis_nakes_rusak_sedang" class="col-9 form-label form-label-bold text-end">
                        Rusak Sedang
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->rumdis_nakes_rusak_sedang)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rumdis_nakes_rusak_berat" class="col-9 form-label form-label-bold text-end">
                        Rusak Berat
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->rumdis_nakes_rusak_berat)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_rumdis_nakes" class="col-9 form-label form-label-bold text-end">
                        Total Rumah Dinas Nakes
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_rumdis_nakes)" readonly>
                    </div>
                </div>
            </div>

        </div>
        <hr>

        {{-- 7. UKBM --}}
        <div class="row" id="ukbm">
            <h2 class="main-title">7. UKBM</h2>

            {{-- JUMLAH UKBM --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Jumlah UKBM</h4>
                <div class="row mb-3">
                    <label for="jml_poskesdes" class="col-9 form-label form-label-bold text-end">
                        Poskesdes
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_poskesdes)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_poskestren" class="col-9 form-label form-label-bold text-end">
                        Poskestren
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_poskestren)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_posyandu_lansia" class="col-9 form-label form-label-bold text-end">
                        Posyandu Lansia
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_posyandu_lansia)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_posbindu_ptm_aktif" class="col-9 form-label form-label-bold text-end">
                        Posbindu PTM Aktif
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_posbindu_ptm_aktif)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_ukbm" class="col-9 form-label form-label-bold text-end">
                        Total UKBM
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_ukbm)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->jml_posyandu_pratama)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_posyandu_madya" class="col-9 form-label form-label-bold text-end">
                        Posyandu Madya
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_posyandu_madya)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_posyandu_purnama" class="col-9 form-label form-label-bold text-end">
                        Posyandu Purnama
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_posyandu_purnama)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_posyandu_mandiri" class="col-9 form-label form-label-bold text-end">
                        Posyandu Mandiri
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_posyandu_mandiri)" readonly>
                    </div>
                </div>

                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_posyandu" class="col-9 form-label form-label-bold text-end">
                        Total Posyandu
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_posyandu)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->jml_ukbm_posyandu)" readonly>
                    </div>
                </div>
            </div>

        </div>
        <hr>

        {{-- 8. SARANA PUSKESMAS --}}
        <div class="row" id="sarana-puskesmas">
            <h2 class="main-title">8. Sarana Puskesmas</h2>

            {{-- TEMPAT TIDUR, SIMPUS, KETERSEDIAAN --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Tempat Tidur</h4>
                <div class="row mb-3">
                    <label for="jml_tt_perawatan_umum" class="col-9 form-label form-label-bold text-end">
                        Jumlah TT Perawatan Umum
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_tt_perawatan_umum)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_tt_perawatan_persalinan" class="col-9 form-label form-label-bold text-end">
                        Jumlah TT Perawatan Persalinan
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_tt_perawatan_persalinan)" readonly>
                    </div>
                </div>

                <h4 class="content-title mt-4">SIMPUS</h4>
                <div class="form-group">
                    <label for="nama_aplikasi_pencatatan" class="form-label form-label-bold">
                        Nama Aplikasi Pencatatan Puskesmas (25 karakter)
                    </label>
                    <input type="text" class="form-control" value="{{ $data->nama_aplikasi_pencatatan }}"
                        readonly>
                </div>

                <h4 class="content-title mt-4">Ketersediaan Lainnya</h4>
                {{-- Listrik --}}
                <div class="form-group">
                    <label for="waktu_ketersediaan_listrik" class="form-label form-label-bold">
                        Waktu Ketersediaan Listrik
                    </label>
                    <input type="text" class="form-control" value="{{ $data->waktu_ketersediaan_listrik }}"
                        readonly>
                </div>
                {{-- Telepon Kabel --}}
                <div class="form-group">
                    <label for="telepon_kabel" class="form-label form-label-bold">
                        Telepon Kabel
                    </label>
                    <input type="text" class="form-control" value="{{ $data->telepon_kabel }}" readonly>
                </div>
                {{-- Radio Komunikasi --}}
                <div class="form-group">
                    <label for="radio_komunikasi" class="form-label form-label-bold">
                        Radio Komunikasi
                    </label>
                    <input type="text" class="form-control" value="{{ $data->radio_komunikasi }}" readonly>
                </div>
                {{-- Jaringan Internet --}}
                <div class="form-group">
                    <label for="jaringan_internet" class="form-label form-label-bold">
                        Jaringan Internet
                    </label>
                    <input type="text" class="form-control" value="{{ $data->jaringan_internet }}" readonly>
                </div>
            </div>

            {{-- SUMBER AIR, LISTRIK --}}
            <div class="col-lg-4 mt-4 mt-lg-0 devide-right">
                <h4 class="content-title">Sumber Air Bersih</h4>
                <input type="text" class="form-control" value="{{ $data->sumber_air }}" readonly>

                <h4 class="content-title mt-4">Sumber Listrik</h4>
                <input type="text" class="form-control" value="{{ $data->sumber_listrik }}" readonly>
            </div>

            {{-- AKSES JALAN, KENDARAAN LEWAT, WAKTU TEMPUH --}}
            <div class="col-lg-4 mt-4 mt-lg-0">
                <h4 class="content-title">Akses Jalan Depan Gedung Puskesmas</h4>
                <input type="text" class="form-control" value="{{ $data->akses_jalan_depan }}" readonly>

                <h4 class="content-title mt-4">Kendaraan Yang Dapat Lewat Melalui Jalan Depan Puskesmas</h4>
                <input type="text" class="form-control" value="{{ $data->kendaraan_lewat }}" readonly>

                <h4 class="content-title mt-4">Waktu Tempuh</h4>
                <div class="row mb-3">
                    <label for="waktu_tempuh" class="col-9 form-label form-label-bold text-end">
                        Waktu tempuh terlama bagi warga menuju puskesmas (menit)
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->waktu_tempuh)" readonly>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {{-- 9. KONDISI PENGOLAH DATA --}}
        <div class="row" id="kondisi-pengolah-data">
            <h2 class="main-title">9. Pengolah Data Puskesmas</h2>

            {{-- KOMPUTER --}}
            <div class="col-lg-4 devide-right">
                <h4 class="content-title">Perangkat Komputer</h4>
                <div class="row mb-3">
                    <label for="komputer_berfungsi" class="col-9 form-label form-label-bold text-end">
                        Berfungsi
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->komputer_berfungsi)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="komputer_tidak_berfungsi" class="col-9 form-label form-label-bold text-end">
                        Tidak Berfungsi
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->komputer_tidak_berfungsi)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_komputer" class="col-9 form-label form-label-bold text-end">
                        Jumlah Komputer
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_komputer)" readonly>
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
                        <input type="text" class="form-control number" value="@numb($data->laptop_berfungsi)" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="laptop_tidak_berfungsi" class="col-9 form-label form-label-bold text-end">
                        Tidak Berfungsi
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->laptop_tidak_berfungsi)" readonly>
                    </div>
                </div>
                <hr class="line">
                <div class="row mb-3">
                    <label for="jml_laptop" class="col-9 form-label form-label-bold text-end">
                        Jumlah Laptop
                    </label>
                    <div class="col-3">
                        <input type="text" class="form-control number" value="@numb($data->jml_laptop)" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
