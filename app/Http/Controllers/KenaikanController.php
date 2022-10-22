<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PosModel;
use App\KelasModel;
use App\SiswaModel;
use App\TahunModel;
use App\RiwayatKelasModel;
use App\PaymentModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class KenaikanController extends Controller
{
  public function setkenaikan(){
    $id   = Session::get('idsekolah');
    $data = KelasModel::where('id_sekolahkelas',$id)
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_kelas.id_sekolahkelas')
            ->get();
    return view('operator.kenaikan.kenaikan',['kls'=>$data]);
  }

  public function lihatsiswakelas(Request $request){
    $idsek     = Session::get('idsekolah');
    $tahunid     = TahunModel::select('id_tahun')->where('status','Y')->first();
    $idkelas   = $request->idkelas;
    $editkelas = KelasModel::where('id_sekolahkelas',$idsek)->where('id_kelas',$idkelas)->first();
    $kls       = KelasModel::where('id_sekolahkelas',$idsek)->where('kelas','!=','Tamat')->get();
    $tahun     = TahunModel::all();
    $datasiswa = SiswaModel::where('riwayat_kelas.id_tahun',$tahunid->id_tahun)
                  ->where('tbl_tahunajaran.status','!=','T')
                  ->where('tbl_siswa.statussiswa','!=','Alumni')
                  ->where('id_sekolahsiswa',$idsek)
                  ->where('riwayat_kelas.id_kelas',$idkelas)
                  ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')
                  ->join('riwayat_kelas','riwayat_kelas.nis','tbl_siswa.nis')
                  ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','riwayat_kelas.id_tahun')->get();
    return view('operator.kenaikan.lihatsiswakelas',['kls'=>$kls],['dkelas'=>$editkelas])->with(['data'=>$datasiswa])
              ->with(['tahun'=>$tahun]); // melempar data ke view

    }
    public function aksinaikkelas(Request $request){
      $idsek = Session::get('idsekolah');
      $nis = $request->idsiswa;
      $idkelas = $request->idkelas;
           foreach( $nis as $key => $n ) {
                $data = [
                      'id_kelas' => $idkelas
                  ];
                  $check = RiwayatKelasModel::where('nis',$n)->where('id_kelas',$idkelas)->where('id_tahun',$request->idtahun)->count();
                  $idriwayat = RiwayatKelasModel::select('id_riwayatkelas')->where('nis',$n)->where('id_kelas',$idkelas)->where('id_tahun',$request->idtahun)->first();
                  if($check > 0){
                    $store = SiswaModel::where('id_sekolahsiswa',$idsek)->where('nis',$n)
                             ->update($data);
                             $riwayatkelas = [
                                'nis'=>$n,
                                'id_kelas' => $idkelas,
                                'id_tahun' => $request->idtahun,
                                'keterangan'=>'Naik Kelas'

                             ];
                             $riwayat= RiwayatKelasModel::where('id_riwayatkelas',$idriwayat)->update($riwayatkelas);
                  }else{
                    $store = SiswaModel::where('id_sekolahsiswa',$idsek)->where('nis',$n)
                             ->update($data);
                             $riwayatkelas = [
                                'nis'=>$n,
                                'id_kelas' => $idkelas,
                                'id_tahun' => $request->idtahun,
                                'keterangan'=>'Naik Kelas'

                             ];
                             $riwayat= RiwayatKelasModel::insert($riwayatkelas);
                  }

          }
            return redirect('/kenaikan/setkenaikan')->with('success','Aksi Berhasil');

  }

  //kelulusan
  public function setkelulusan(){
    $id   = Session::get('idsekolah');
    $data = KelasModel::where('id_sekolahkelas',$id)
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_kelas.id_sekolahkelas')
            ->get();
    return view('operator.kelulusan.kelulusan',['kls'=>$data]);
  }

  public function lihatsiswakelaslulus(Request $request){
    $idsek     = Session::get('idsekolah');
    $tahunid   = TahunModel::select('id_tahun')->where('status','Y')->first();
    $idkelas   = $request->idkelas;
    $editkelas = KelasModel::where('id_sekolahkelas',$idsek)->where('id_kelas',$idkelas)->first();
    $kls       = KelasModel::where('id_sekolahkelas',$idsek)->where('kelas','!=','Tamat')->get();
    $tahun     = TahunModel::all();
    $datasiswa = SiswaModel::where('riwayat_kelas.id_tahun',$tahunid->id_tahun)
                  ->where('tbl_tahunajaran.status','!=','T')
                  ->where('tbl_siswa.statussiswa','!=','Alumni')
                  ->where('id_sekolahsiswa',$idsek)
                  ->where('riwayat_kelas.id_kelas',$idkelas)
                  ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')
                  ->join('riwayat_kelas','riwayat_kelas.nis','tbl_siswa.nis')
                  ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','riwayat_kelas.id_tahun')->get();
    return view('operator.kelulusan.lihatsiswakelas',['kls'=>$kls],['dkelas'=>$editkelas])->with(['data'=>$datasiswa])
              ->with(['tahun'=>$tahun]); // melempar data ke view

    }

    public function aksilulus(Request $request){
      $idsek     = Session::get('idsekolah');
      $nis       = $request->idsiswa;
      $lulus     = KelasModel::where('id_sekolahkelas',$idsek)->where('kelas','Lulus')->count();
      $idlulus   = KelasModel::where('id_sekolahkelas',$idsek)->where('kelas','Lulus')->first();
      if($lulus > 0){

           foreach( $nis as $key => $n ) {
                $data = [
                      'id_kelas' => $idlulus,
                      'statussiswa' =>'Lulus'
                  ];
                  $check = RiwayatKelasModel::where('nis',$n)->where('id_kelas',$idkelas)->where('id_tahun',$request->idtahun)->count();
                  $idriwayat = RiwayatKelasModel::select('id_riwayatkelas')->where('nis',$n)->where('id_kelas',$idkelas)->where('id_tahun',$request->idtahun)->first();
                  if($check > 0){
                   return back()->with('danger', 'Aksi Gagal');
                 }
                  else{
                    $store = SiswaModel::where('id_sekolahsiswa',$idsek)->where('nis',$n)
                             ->update($data);
                             $riwayatkelas = [
                                'nis'=>$n,
                                'id_kelas' => $idlulus,
                                'id_tahun' => $request->idtahun,
                                'keterangan'=>'Lulus'

                             ];
                             $riwayat= RiwayatKelasModel::insert($riwayatkelas);
                  }
          }

          return redirect('/kelulusan/setkelulusan')->with('success','Aksi Berhasil');

        }
        else{
          return redirect('/kelulusan/setkelulusan')->with('danger', 'Aksi Gagal tidak menemukan status lulus, Buat Kelas dengan nama "Lulus"');
        }



  }



}
