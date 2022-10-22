<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BayarBulanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('bayar_bulanan', function (Blueprint $table) {
            $table->bigIncrements('id_bayarbulan');
            $table->Integer('id_tarifbulan');
            $table->string('nis',50);
            $table->Integer('jumlah_bayar');
            $table->date('tanggal');
            $table->string('status',1);
            $table->Integer('idsekolahbb');
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
        Schema::dropIfExists('bayar_bulanan');
    }
}
