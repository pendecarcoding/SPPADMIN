<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa',function(Blueprint $table){
            $table->bigIncrements('id_siswa');
            $table->String('nis',225);
            $table->String('nama',50);
            $table->String('tpt_lahir',225);
            $table->String('tgl_lahir',50);
            $table->Integer('id_kelas');
            $table->String('nama_ibu',50);
            $table->String('foto',255);
            $table->Text('alamat');
            $table->Integer('id_sekolahsiswa');
            $table->Integer('idtahunmasuksiswa');
            $table->String('statussiswa',15);
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
        Schema::dropIfExists('tbl_siswa');
    }
}
