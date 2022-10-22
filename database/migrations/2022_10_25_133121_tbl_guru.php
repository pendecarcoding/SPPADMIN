<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblGuru extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tbl_guru', function (Blueprint $table) {
            $table->bigIncrements('id_guru');
            $table->String('nip',18);
            $table->String('nama_guru',50);
            $table->Text('alamat');
            $table->String('nohp',12);
            $table->String('email',100);
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
        Schema::dropIfExists('tbl_guru');
    }
}
