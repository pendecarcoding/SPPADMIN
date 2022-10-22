<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKebijakan extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tbl_kebijakan', function (Blueprint $table) {
            $table->bigIncrements('id_kebijakan');
            $table->String('kebijakan',255);
            $table->Integer('id_tahun');
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
        Schema::dropIfExists('tbl_kebijakan');
    }
}
