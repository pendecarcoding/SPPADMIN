<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TarifBebas extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tarif_bebas', function (Blueprint $table) {
            $table->bigIncrements('id_tarifbebas');
            $table->Integer('id_jenispayment');
            $table->Integer('id_kelas');
            $table->Integer('tarifbebas');
            $table->Integer('id_tahun');
            $table->Integer('idsekolahbebas');
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
        Schema::dropIfExists('tarif_bebas');
    }
}
