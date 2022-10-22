<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kesehatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kesehatan',function(Blueprint $table){
            $table->bigIncrements('id')->autoincerement();
            $table->integer('id_siswa');
            $table->integer('id_kelas');
            $table->Text('kesehatan');
            $table->Date('tgl_checkup');
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
        Schema::dropIfExists('tbl_kesehatan');
    }
}
