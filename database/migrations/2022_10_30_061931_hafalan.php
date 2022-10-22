<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hafalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tbl_hafalan',function(Blueprint $table){
            $table->bigIncrements('id')->autoincerement();
            $table->integer('id_siswa');
            $table->integer('id_kelas');
            $table->String('batas_hafalan',225);
            $table->Date('tgl_setor');
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
        //
    }
}
