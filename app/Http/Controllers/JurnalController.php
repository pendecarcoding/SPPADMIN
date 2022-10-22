<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PengeluaranModel;
use App\PosModel;
use App\PaymentModel;
use App\PemasukanModel;
use App\JenispengeluaranModel;
use App\TahunModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class JurnalController extends Controller
{
  public function pemasukan(){
    $id    = Session::get('idsekolah');
    $data  = PemasukanModel::where('id_sekolahpe',$id)
            ->where('status','Y')
            ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pemasukan.id_tahun')->get();
    $th    = TahunModel::where('status','Y')->get();
    return view('operator.jurnalumum.pemasukan',['data'=>$data],['tahun'=>$th]);
  }

  public function tambahsumber(Request $request){
    $id   = Session::get('idsekolah');
    $data = [
                'sumber' => $request->dana,
                'nominal' => $request->nominal,
                'tanggal' => $request->tanggal,
                'id_tahun' => $request->idtahun,
                'id_sekolahpe' => $id
            ];

            // di bawah ini proses insert ke tabel kendaraan

            $store = PemasukanModel::insert($data);
            return redirect('/jurnalumum/pemasukan')->with('success','Data berhasil di simpan');

 }

 public function delpemasukan($id=null){
    $action   = PemasukanModel::where('id_pemasukan',$id)->delete();
    return redirect ('/jurnalumum/pemasukan')->with('success','Data berhasil dihapus');
 }
 public function editpemasukan($idp=null){
   $idp   = base64_decode($idp);
   $id    = Session::get('idsekolah');
   $check = PemasukanModel::where('id_pemasukan',$idp)->count();
   if($check > 0){
     $data  = PemasukanModel::where('id_sekolahpe',$id)
             ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pemasukan.id_tahun')->get();
     $th    = TahunModel::where('status','Y')->get();
     $e     = PemasukanModel::where('id_pemasukan',$idp)->where('id_sekolahpe',$id)
             ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pemasukan.id_tahun')->first();
     return view('operator.jurnalumum.pemasukanedit',['data'=>$data],['tahun'=>$th])->with(['e'=>$e]);
   }else{
     return redirect('/jurnalumum/pemasukan')->with('danger','Data tidak tersedia');
   }

 }

 public function updatesumber(Request $request){
   $id   = Session::get('idsekolah');
   $check = PemasukanModel::where('id_pemasukan',$request->id)->count();
   if($check > 0){
     $data = [
                 'sumber' => $request->dana,
                 'nominal' => $request->nominal,
                 'tanggal' => $request->tanggal,
                 'id_tahun' => $request->idtahun,
                 'id_sekolahpe' => $id
             ];

             // di bawah ini proses insert ke tabel kendaraan

             $store = PemasukanModel::where('id_pemasukan',$request->id)->update($data);
             return redirect('/jurnalumum/pemasukan')->with('success','Data berhasil di update');
   }
   else{
     return redirect('/jurnalumum/pemasukan')->with('danger','Data tidak tersedia');
   }


}

public function jenispengeluaran(){
  $id    = Session::get('idsekolah');
  $th    = TahunModel::where('status','Y')->get();
  $data  = JenispengeluaranModel::where('status','Y')->where('idkatsekolah',$id)->where('tbl_tahunajaran.status','Y')
          ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','kat_pengeluaran.id_tahun')->get();

  return view('operator.pengeluaran.jenispengeluaran',['data'=>$data],['tahun'=>$th]);
}

public function deljenispengeluaran($id=null){
   $check    = PengeluaranModel::where('id_katpengeluaran',$id)->count();
   if($check > 0){
     return redirect ('/jurnalumum/jenispengeluaran')->with('danger','Data berelasi dengan data pengeluaran');
   }else{
     $action   = JenispengeluaranModel::where('id_katpengeluaran',$id)->delete();
     return redirect ('/jurnalumum/jenispengeluaran')->with('success','Data berhasil dihapus');
   }

}
public function tambahjenispengeluaran(Request $request){
  $id   = Session::get('idsekolah');

    $data = [
                'katpengeluaran' => $request->jenis,
                'id_tahun' => $request->idtahun,
                'idkatsekolah' => $id
            ];

            // di bawah ini proses insert ke tabel kendaraan

            $store = JenispengeluaranModel::insert($data);
            return redirect('/jurnalumum/jenispengeluaran')->with('success','Data berhasil di simpan');
  }

  public function jenispengeluaranedit($idpe=null){
    $idpe  = base64_decode($idpe);
    $check = JenispengeluaranModel::where('id_katpengeluaran',$idpe)->count();
    if($check > 0){
      $id    = Session::get('idsekolah');
      $th    = TahunModel::where('status','Y')->get();
      $e     = JenispengeluaranModel::where('id_katpengeluaran',$idpe)->where('idkatsekolah',$id)->where('tbl_tahunajaran.status','Y')
              ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','kat_pengeluaran.id_tahun')->first();
      $data  = JenispengeluaranModel::where('idkatsekolah',$id)->where('tbl_tahunajaran.status','Y')
              ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','kat_pengeluaran.id_tahun')->get();

      return view('operator.pengeluaran.jenispengeluaranedit',['data'=>$data],['tahun'=>$th])->with(['e'=>$e]);
    }else{
      return redirect('/jurnalumum/jenispengeluaran')->with('danger','Data tidak tersedia');
    }

  }

  public function updatejenispengeluaran(Request $request){
    $id   = Session::get('idsekolah');

      $data = [
                  'katpengeluaran' => $request->jenis,
                  'id_tahun' => $request->idtahun,
                  'idkatsekolah' => $id
              ];

              // di bawah ini proses insert ke tabel kendaraan

              $store = JenispengeluaranModel::where('id_katpengeluaran',$request->id)->update($data);
              return redirect('/jurnalumum/jenispengeluaran')->with('success','Data berhasil di update');
    }

    //Pengeluaran
    public function pengeluaran(){
      $id   = Session::get('idsekolah');
      $data = PengeluaranModel::where('tbl_tahunajaran.status','Y')
      ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pengeluaran.id_tahun')
      ->join('tbl_sekolah','tbl_sekolah.id_sekolah','pengeluaran.idsekolahkeluar')
      ->join('kat_pengeluaran','kat_pengeluaran.id_katpengeluaran','=','pengeluaran.id_katpengeluaran')->get();
      $datakategori  = JenispengeluaranModel::where('idkatsekolah',$id)->get();
      $th    = TahunModel::where('status','Y')->get();
      return view('operator.pengeluaran.pengeluaran',['data'=>$data],['j'=>$datakategori])->with(['tahun'=>$th]);
    }

    public function tambahpengeluaran(Request $request){
      $id   = Session::get('idsekolah');
            $data = [
                  'penggunaan' => $request->kegunaan,
                  'nominal' => $request->nominal,
                  'tanggal' => $request->tanggal,
                  'id_katpengeluaran' => $request->idkategori,
                  'idsekolahkeluar' => $id,
                  'id_tahun' => $request->idtahun
              ];

              // di bawah ini proses insert ke tabel kendaraan

              $store = PengeluaranModel::insert($data);
              return redirect('/jurnalumum/pengeluaran')->with('success','Data berhasil disimpan');



        }
        public function delpengeluaran($id=null){
             $action   = pengeluaranModel::where('id_pengeluaran',$id)->delete();
             return redirect ('/jurnalumum/pengeluaran')->with('success','Data berhasil dihapus');


        }
        public function pengeluaranedit($idpe=null){
          $idpe = base64_decode($idpe);
          $id   = Session::get('idsekolah');
          $check = PengeluaranModel::where('id_pengeluaran',$idpe)->where('tbl_tahunajaran.status','Y')
          ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pengeluaran.id_tahun')
          ->join('tbl_sekolah','tbl_sekolah.id_sekolah','pengeluaran.idsekolahkeluar')
          ->join('kat_pengeluaran','kat_pengeluaran.id_katpengeluaran','=','pengeluaran.id_katpengeluaran')->count();
          if($check > 0){
            $e    = PengeluaranModel::where('id_pengeluaran',$idpe)->where('tbl_tahunajaran.status','Y')
                    ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pengeluaran.id_tahun')
                    ->join('tbl_sekolah','tbl_sekolah.id_sekolah','pengeluaran.idsekolahkeluar')
                    ->join('kat_pengeluaran','kat_pengeluaran.id_katpengeluaran','=','pengeluaran.id_katpengeluaran')->first();
            $data = PengeluaranModel::where('tbl_tahunajaran.status','Y')
                    ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','pengeluaran.id_tahun')
                    ->join('tbl_sekolah','tbl_sekolah.id_sekolah','pengeluaran.idsekolahkeluar')
                    ->join('kat_pengeluaran','kat_pengeluaran.id_katpengeluaran','=','pengeluaran.id_katpengeluaran')->get();
            $datakategori  = JenispengeluaranModel::where('idkatsekolah',$id)->get();
            $th    = TahunModel::where('status','Y')->get();
            return view('operator.pengeluaran.pengeluaranedit',['data'=>$data],['j'=>$datakategori])->with(['tahun'=>$th])->with(['e'=>$e]);

          }else{
            return redirect ('/jurnalumum/pengeluaran')->with('danger','Data tidak tersedia');
          }

        }

        public function updatepengeluaran(Request $request){
          $id   = Session::get('idsekolah');
                $data = [
                      'penggunaan' => $request->kegunaan,
                      'nominal' => $request->nominal,
                      'tanggal' => $request->tanggal,
                      'id_katpengeluaran' => $request->idkategori,
                      'idsekolahkeluar' => $id,
                      'id_tahun' => $request->idtahun
                  ];

                  // di bawah ini proses insert ke tabel kendaraan

                  $store = PengeluaranModel::where('id_pengeluaran',$request->id)->update($data);
                  return redirect('/jurnalumum/pengeluaran')->with('success','Data berhasil diupdate');



            }





 }
