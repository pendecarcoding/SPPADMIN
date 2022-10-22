<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TarifBulanan extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tarif_bulanan', function (Blueprint $table) {
            $table->bigIncrements('id_tarifbulan');
            $table->Integer('id_jenispayment');
            $table->Integer('id_bulan');
            $table->Integer('id_kelas');
            $table->Integer('harga_tarif');
            $table->Integer('id_tahun');
            $table->Integer('idsekolahtarif');
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
        Schema::dropIfExists('tarif_bulanan');
    }
}
