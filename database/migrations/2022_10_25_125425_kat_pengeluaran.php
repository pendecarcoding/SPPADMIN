<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KatPengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kat_pengeluaran', function (Blueprint $table) {
            $table->bigIncrements('id_katpengeluaran');
            $table->string('katpengeluaran',100);
            $table->Integer('id_tahun');
            $table->Integer('idkatsekolah');
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
        Schema::dropIfExists('kat_pengeluaran');
    }
}
