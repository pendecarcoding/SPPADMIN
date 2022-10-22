<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblWaimurid extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_walimurid',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->String('nama',100);
            $table->String('nohp',12);
            $table->Text('alamat');
            $table->String('email',100);
            $table->Integer('id_sekolah');
            $table->Text('password');
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
        Schema::dropIfExists('tbl_walimurid');
    }
}
