<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RiwayatKelas extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('riwayat_kelas', function (Blueprint $table) {
            $table->bigIncrements('id_riwayatkelas');
            $table->String('nis',11);
            $table->Integer('id_sekolah');
            $table->Integer('id_kelas');
            $table->Integer('id_tahun');
            $table->String('keterangan',50);
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
        Schema::dropIfExists('riwayat_kelas');
    }
}
