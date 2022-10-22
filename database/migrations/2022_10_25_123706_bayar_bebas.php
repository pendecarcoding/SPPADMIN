<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BayarBebas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayar_bebas', function (Blueprint $table) {
            $table->bigIncrements('id_bayarbebas');
            $table->Integer('id_tarifbebas');
            $table->string('nis',50);
            $table->Integer('jumlah_bayar');
            $table->date('tanggal');
            $table->string('status',1);
            $table->Integer('idsekolahbe');
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
        Schema::dropIfExists('bayar_bebas');
    }
}
