<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblWalikelas extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_walikelas',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->Integer('id_guru');
            $table->Integer('id_kelas');
            $table->Integer('id_tahun');
            $table->enum('akses',['Y','N'])->default('N');
            $table->Integer('id_akses');
            $table->String('kode_akses',30);
            $table->Integer('id_sekolah');
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
        Schema::dropIfExists('tbl_walikelas');
    }
}
