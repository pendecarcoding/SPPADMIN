<?php

namespace App\Repositories;

use App\Interfaces\HafalanInterfaces;
use App\SiswaModel;
use App\WkModel;
use App\HafalanModel;
use Session;

class HafalanRepository implements HafalanInterfaces
{
    public function getAll()
    {
        $wk = WkModel::where('id_akses',Session::get('id_user'))->first();
        return SiswaModel::where('id_sekolahsiswa',Session::get('idsekolah'))
            ->where('statussiswa','Aktif')
            ->where('tbl_siswa.id_kelas',$wk->id_kelas)
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();
    }
    public function getAllStudent(){
        $wk = WkModel::where('id_akses',Session::get('id_user'))->first();
        return SiswaModel::where('id_sekolahsiswa',Session::get('idsekolah'))
            ->where('statussiswa','Aktif')
            ->where('tbl_siswa.id_kelas',$wk->id_kelas)
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->join('tbl_hafalan','tbl_hafalan.id_siswa','tbl_siswa.id_siswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();
    }

    public function getById($id)
    {
        return HafalanModel::where('id',$id)->first();
    }

    public function delete($id)
    {
        return HafalanModel::where('id',$id)->delete();
    }

    public function create(array $array)
    {
        return HafalanModel::create($array);

    }

    public function update($id, array $data)
    {
        return HafalanModel::where('id',$id)->update($data);
    }

     public function getApistudent($kelas,$idsekolah,array $nis){
       return $data = SiswaModel::where('id_sekolahsiswa',$idsekolah)
            ->where('statussiswa','Aktif')
            ->where('tbl_siswa.id_kelas',$kelas)
            ->whereIn('tbl_siswa.nis',$nis)
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->join('tbl_hafalan','tbl_hafalan.id_siswa','tbl_siswa.id_siswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();

    }

    public function getFulfilledOrders()
    {
        return GuruModel::where('is_fulfilled', true);
    }
}
