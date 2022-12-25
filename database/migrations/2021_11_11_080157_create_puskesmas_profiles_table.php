<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuskesmasProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puskesmas_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->year('tahun');
            $table->foreignId('user_id');
            $table->string('nama_puskesmas');
            $table->string('jenis_puskesmas');
            $table->foreignId('id_provinsi');
            $table->foreignId('id_kabupaten');
            $table->foreignId('id_kecamatan');
            $table->foreignId('id_desa');
            $table->text('alamat_puskesmas');
            $table->string('kode_pos');
            $table->string('nomor_telp');
            $table->string('nomor_fax')->nullable();
            $table->string('email_puskesmas');
            $table->string('nama_kontak');
            $table->string('telp_kontak');
            $table->string('email_kontak');
            $table->integer('luas_wilayah');
            $table->integer('jml_desa');
            $table->integer('jml_kk');
            $table->integer('jml_penduduk');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('kriteria_puskesmas');
            $table->string('keadaan_bangunan');
            $table->string('status_akreditasi');
            $table->integer('jml_dk');
            $table->integer('jml_dk_gigi');
            $table->integer('jml_perawat');
            $table->integer('jml_bidan');
            $table->integer('jml_tk_masyarakat');
            $table->integer('jml_tk_lingkungan');
            $table->integer('jml_tenaga_gizi');
            $table->integer('jml_ahli_tek_medik');
            $table->integer('jml_farmasi');
            $table->integer('jml_tenaga_kesehatan');
            $table->integer('jml_tenaga_penunjang');
            $table->integer('jml_tenaga_puskesmas');
            $table->integer('ambulance_baik');
            $table->integer('ambulance_rusak_ringan');
            $table->integer('ambulance_rusak_berat');
            $table->integer('jml_ambulance');
            $table->integer('motor_baik');
            $table->integer('motor_rusak_ringan');
            $table->integer('motor_rusak_berat');
            $table->integer('jml_motor');
            $table->integer('pusling_baik');
            $table->integer('pusling_rusak_ringan');
            $table->integer('pusling_rusak_berat');
            $table->integer('jml_pusling');
            $table->integer('pusling_perairan_baik');
            $table->integer('pusling_perairan_rusak_ringan');
            $table->integer('pusling_perairan_rusak_berat');
            $table->integer('jml_pusling_perairan');
            $table->integer('pustu_baik');
            $table->integer('pustu_rusak_ringan');
            $table->integer('pustu_rusak_sedang');
            $table->integer('pustu_rusak_berat');
            $table->integer('jml_pustu');
            $table->integer('rumdis_nakes_baik');
            $table->integer('rumdis_nakes_rusak_ringan');
            $table->integer('rumdis_nakes_rusak_sedang');
            $table->integer('rumdis_nakes_rusak_berat');
            $table->integer('jml_rumdis_nakes');
            $table->integer('jml_poskesdes');
            $table->integer('jml_poskestren');
            $table->integer('jml_posyandu_lansia');
            $table->integer('jml_posbindu_ptm_aktif');
            $table->integer('jml_ukbm');
            $table->integer('jml_posyandu_pratama');
            $table->integer('jml_posyandu_madya');
            $table->integer('jml_posyandu_purnama');
            $table->integer('jml_posyandu_mandiri');
            $table->integer('jml_posyandu');
            $table->integer('jml_ukbm_posyandu');
            $table->integer('jml_tt_perawatan_umum');
            $table->integer('jml_tt_perawatan_persalinan');
            $table->string('nama_aplikasi_pencatatan', 25);
            $table->string('sumber_air');
            $table->string('sumber_listrik');
            $table->string('akses_jalan_depan');
            $table->string('kendaraan_lewat');
            $table->integer('waktu_tempuh');
            $table->string('waktu_ketersediaan_listrik');
            $table->string('telepon_kabel');
            $table->string('radio_komunikasi');
            $table->string('jaringan_internet');
            $table->integer('komputer_berfungsi');
            $table->integer('komputer_tidak_berfungsi');
            $table->integer('jml_komputer');
            $table->integer('laptop_berfungsi');
            $table->integer('laptop_tidak_berfungsi');
            $table->integer('jml_laptop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puskesmas_profiles');
    }
}
