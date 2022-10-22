<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id_admin');
            $table->string('username',30);
            $table->string('password',50);
            $table->string('nama',30);
            $table->string('jabatan',25);
            $table->string('nohpuser',15);
            $table->Integer('idsekolah');
            $table->String('level',25);
            $table->String('foto',225);
            $table->String('colour',10);
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
        Schema::dropIfExists('admin');
    }
}
