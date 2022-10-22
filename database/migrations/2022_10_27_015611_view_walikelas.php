<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ViewWalikelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement(" CREATE VIEW view_walikelas AS
        select
        tbl_guru.email as email,
        tbl_walikelas.id AS id,
        tbl_walikelas.kode_akses AS kode_akses,
        tbl_walikelas.akses AS akses,
        tbl_guru.nama_guru AS nama_guru,
        tbl_kelas.kelas AS kelas,
        (select count(0) from tbl_siswa where tbl_siswa.id_kelas = tbl_walikelas.id_kelas)
        AS jumlah_siswa
        from (((tbl_walikelas join tbl_guru on(tbl_walikelas.id_guru = tbl_guru.id_guru))
        join tbl_kelas on(tbl_walikelas.id_kelas = tbl_kelas.id_kelas))
        join tbl_tahunajaran on(tbl_walikelas.id_tahun = tbl_tahunajaran.id_tahun))
        ");
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
