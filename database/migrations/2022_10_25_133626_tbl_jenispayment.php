<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblJenispayment extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tbl_jenispayment', function (Blueprint $table) {
            $table->bigIncrements('id_jenispayment');
            $table->String('namapayment',18);
            $table->Integer('id_pos');
            $table->Integer('id_tahun');
            $table->String('tipe',7);
            $table->Integer('rule');
            $table->String('jenis',25);
            $table->Integer('idsekolahpay');
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
        Schema::dropIfExists('tbl_jenispayment');
    }
}
