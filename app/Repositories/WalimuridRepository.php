<?php

namespace App\Repositories;

use App\Interfaces\WalimuridInterfaces;
use App\SiswaModel;
use App\WkModel;
use App\WmModel;
use App\HafalanModel;
use Session;

class WalimuridRepository implements WalimuridInterfaces
{
    public function login($data){
        try {
            $d = WmModel::where('email',$data['email'])
                ->where('password',md5($data['password']))
                ->first();
            if(!empty($d)){
                 $json = [
                'message'=>'success',
                'data'=>$d,
            ];
            return response()->json($json);
            }else{
                 $json = [
                'message'=>'Data Not Found',
            ];
            return response()->json($json);
            }

        } catch (\Throwable $th) {
             $json = [
                'message'=>$th->getmessage(),
            ];
            return response()->json($json);
        }
    }
    public function getAll()
    {
       $data = array();
       $siswa = SiswaModel::all();
       $data  = WmModel::where('id_sekolah',Session::get('idsekolah'))->get();
       $data =[
        'siswa'=>$siswa,
        'data'=>$data,
       ];
       return $data;

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
        return WmModel::where('id',$id)->delete();
    }

    public function create(array $array)
    {
        return WmModel::create($array);

    }

    public function update($id, array $data)
    {
        return WmModel::where('id',$id)->update($data);
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
