<?php

namespace App\Repositories;

use App\Interfaces\KesehatanInterfaces;
use App\SiswaModel;
use App\WkModel;
use App\KesehatanModel;
use Session;

class KesehatanRepository implements KesehatanInterfaces
{

    public function getApistudent($kelas,$idsekolah,array $nis){
       return $data = SiswaModel::where('id_sekolahsiswa',$idsekolah)
            ->where('statussiswa','Aktif')
            ->where('tbl_siswa.id_kelas',$kelas)
            ->whereIn('tbl_siswa.nis',$nis)
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->join('tbl_kesehatan','tbl_kesehatan.id_siswa','tbl_siswa.id_siswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();

    }
    public function getAll()
    {
        //return GuruModel::all();
    }
    public function getAllStudent(){
        $wk = WkModel::where('id_akses',Session::get('id_user'))->first();
        return SiswaModel::where('id_sekolahsiswa',Session::get('idsekolah'))
            ->where('statussiswa','Aktif')
            ->where('tbl_siswa.id_kelas',$wk->id_kelas)
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->join('tbl_kesehatan','tbl_kesehatan.id_siswa','tbl_siswa.id_siswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();
    }

    public function getById($id)
    {
        return GuruModel::where('id_guru',$id)->first();
    }

    public function delete($id)
    {
        return KesehatanModel::where('id',$id)->delete();
    }

    public function create(array $array)
    {
        return KesehatanModel::create($array);

    }

    public function update($id, array $data)
    {
        return KesehatanModel::where('id',$id)->update($data);
    }

    public function getFulfilledOrders()
    {
        return GuruModel::where('is_fulfilled', true);
    }
}
