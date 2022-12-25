<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority_targets', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id');
            $table->year('tahun');
            $table->integer('jml_penduduk');
            $table->string('satuan_jml_penduduk');
            $table->integer('jml_bayi_lahir_hidup');
            $table->string('satuan_jml_bayi_lahir_hidup');
            $table->integer('jml_bayi');
            $table->string('satuan_jml_bayi');
            $table->integer('jml_balita');
            $table->string('satuan_jml_balita');
            $table->integer('jml_anak_sd_1');
            $table->string('satuan_jml_anak_sd_1');
            $table->integer('jml_anak_sd_2_3');
            $table->string('satuan_jml_anak_sd_2_3');
            $table->integer('jml_anak_b_15_th');
            $table->string('satuan_jml_anak_b_15_th');
            $table->integer('jml_wanita_subur');
            $table->string('satuan_jml_wanita_subur');
            $table->integer('jml_ibu_hamil');
            $table->string('satuan_jml_ibu_hamil');
            $table->integer('jml_ibu_bersalin');
            $table->string('satuan_jml_ibu_bersalin');
            $table->integer('jml_desa');
            $table->string('satuan_jml_desa');
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
        Schema::dropIfExists('priority_targets');
    }
}
