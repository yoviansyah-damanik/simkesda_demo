<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityMonthliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority_monthlies', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id');
            $table->integer('bulan');
            $table->year('tahun');
            $table->integer('jml_k1');
            $table->string('satuan_jml_k1');
            $table->integer('jml_k4');
            $table->string('satuan_jml_k4');
            $table->integer('jml_pn');
            $table->string('satuan_jml_pn');
            $table->integer('jml_ps');
            $table->string('satuan_jml_ps');
            $table->integer('jml_kf');
            $table->string('satuan_jml_kf');
            $table->integer('jml_kn1');
            $table->string('satuan_jml_kn1');
            $table->integer('jml_kn_lengkap');
            $table->string('satuan_jml_kn_lengkap');
            $table->integer('jml_bayi_lahir_hidup');
            $table->string('satuan_jml_bayi_lahir_hidup');
            $table->integer('jml_balita_ditimbang');
            $table->string('satuan_jml_balita_ditimbang');
            $table->integer('jml_balita_gb_perawatan');
            $table->string('satuan_jml_balita_gb_perawatan');
            $table->integer('jml_balita_gb_ditemukan');
            $table->string('satuan_jml_balita_gb_ditemukan');
            $table->integer('jml_imun_bcg');
            $table->string('satuan_jml_imun_bcg');
            $table->integer('jml_imun_hepatitis_b');
            $table->string('satuan_jml_imun_hepatitis_b');
            $table->integer('jml_imun_dpt_1');
            $table->string('satuan_jml_imun_dpt_1');
            $table->integer('jml_imun_dpt_2');
            $table->string('satuan_jml_imun_dpt_2');
            $table->integer('jml_imun_dpt_3');
            $table->string('satuan_jml_imun_dpt_3');
            $table->integer('jml_imun_folio_1');
            $table->string('satuan_jml_imun_folio_1');
            $table->integer('jml_imun_folio_2');
            $table->string('satuan_jml_imun_folio_2');
            $table->integer('jml_imun_folio_3');
            $table->string('satuan_jml_imun_folio_3');
            $table->integer('jml_imun_folio_4');
            $table->string('satuan_jml_imun_folio_4');
            $table->integer('jml_imun_campak');
            $table->string('satuan_jml_imun_campak');
            $table->integer('jml_imun_dasar_lengkap');
            $table->string('satuan_jml_imun_dasar_lengkap');
            $table->integer('jml_pneumonia');
            $table->string('satuan_jml_pneumonia');
            $table->integer('jml_diare');
            $table->string('satuan_jml_diare');
            $table->integer('jml_afp');
            $table->string('satuan_jml_afp');
            $table->integer('jml_malaria_konfirmasi');
            $table->string('satuan_jml_malaria_konfirmasi');
            $table->integer('jml_malaria_positif');
            $table->string('satuan_jml_malaria_positif');
            $table->integer('jml_malaria_pengobatan');
            $table->string('satuan_jml_malaria_pengobatan');
            $table->integer('jml_dbd');
            $table->string('satuan_jml_dbd');
            $table->integer('jml_kematian_dbd');
            $table->string('satuan_jml_kematian_dbd');
            $table->integer('jml_klb');
            $table->string('satuan_jml_klb');
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
        Schema::dropIfExists('priority_monthlies');
    }
}
