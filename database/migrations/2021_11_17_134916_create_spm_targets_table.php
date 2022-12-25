<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpmTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_targets', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->year('tahun');
            $table->foreignId('user_id');
            $table->integer('jml_ibu_hamil');
            $table->string('satuan_jml_ibu_hamil');
            $table->integer('jml_ibu_bersalin');
            $table->string('satuan_jml_ibu_bersalin');
            $table->integer('jml_bayi_baru_lahir');
            $table->string('satuan_jml_bayi_baru_lahir');
            $table->integer('jml_balita');
            $table->string('satuan_jml_balita');
            $table->integer('jml_anak_kelas_1_7');
            $table->string('satuan_jml_anak_kelas_1_7');
            $table->integer('jml_usia_15_59');
            $table->string('satuan_jml_usia_15_59');
            $table->integer('jml_lansia');
            $table->string('satuan_jml_lansia');
            $table->integer('jml_penderita_hipertensi');
            $table->string('satuan_jml_penderita_hipertensi');
            $table->integer('jml_penyandang_dm');
            $table->string('satuan_jml_penyandang_dm');
            $table->integer('jml_odgj_berat');
            $table->string('satuan_jml_odgj_berat');
            $table->integer('jml_penyandang_tb');
            $table->string('satuan_jml_penyandang_tb');
            $table->integer('jml_risiko_infeksi_hiv');
            $table->string('satuan_jml_risiko_infeksi_hiv');
            $table->dateTime('waktu_pengajuan')->nullable();
            $table->dateTime('waktu_perubahan')->nullable();
            $table->char('status_verifikasi', 1)->default(0);
            $table->dateTime('waktu_verifikasi')->nullable();
            $table->foreignId('verifikator_id')->nullable();
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
        Schema::dropIfExists('spm_targets');
    }
}
