<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tbl_sekolah', function (Blueprint $table) {
            $table->bigIncrements('id_sekolah');
            $table->String('nm_sekolah',50);
            $table->String('al_sekolah',100);
            $table->String('kecamatan',20);
            $table->String('kabupaten',30);
            $table->String('nm_kepsek',50);
            $table->Text('logo');
            $table->String('nip_kepsek',50);
            $table->String('bendahara',35);
            $table->String('nipbendahara',35);
            $table->String('website',30);
            $table->String('email',150);
            $table->String('nohp',30);
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
