<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityYearliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority_yearlies', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->year('tahun');
            $table->foreignId('user_id');
            $table->integer('jml_kusta_pb_anak');
            $table->string('satuan_jml_kusta_pb_anak');
            $table->integer('jml_kusta_pb_dewasa');
            $table->string('satuan_jml_kusta_pb_dewasa');
            $table->integer('jml_kusta_mb_anak');
            $table->string('satuan_jml_kusta_mb_anak');
            $table->integer('jml_kusta_mb_dewasa');
            $table->string('satuan_jml_kusta_mb_dewasa');
            $table->integer('jml_cacat_tk_2');
            $table->string('satuan_jml_cacat_tk_2');
            $table->integer('jml_filariasis');
            $table->string('satuan_jml_filariasis');
            $table->integer('jml_obat_cacing');
            $table->string('satuan_jml_obat_cacing');
            $table->integer('jml_posyandu');
            $table->string('satuan_jml_posyandu');
            $table->integer('jml_desa_siaga');
            $table->string('satuan_jml_desa_siaga');
            $table->integer('jml_rt_phbs');
            $table->string('satuan_jml_rt_phbs');
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
        Schema::dropIfExists('priority_yearlies');
    }
}
