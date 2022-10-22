<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PosModel;
use App\KelasModel;
use App\SiswaModel;
use App\PaymentModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class LaporanController extends Controller
{
  public function laporanbulanan(){
     return view('operator.laporan.laporanbulanan');
  }
  public function laporantahunan(){
     return view('operator.laporan.laporantahunan');
  }
  public function cetakpenerimaan(Request $request){
                $tgl_awal = $request->tgl_awal;
                $tgl_akhir = $request->tgl_akhir;
                $pdf = PDF::loadView('operator.laporan.laporanpenerimaan',['tgl_awal'=>$tgl_awal],['tgl_akhir'=>$tgl_akhir]);
                return $pdf->download("invoice_Penerimaandana_{$tgl_awal}_{$tgl_akhir}.pdf");

  }
  public function cetakpengeluaran(Request $request){
    $tgl_awal = $request->tgl_awal;
    $tgl_akhir = $request->tgl_akhir;
    $pdf = PDF::loadView('operator.laporan.laporanpengeluaran',['tgl_awal'=>$tgl_awal],['tgl_akhir'=>$tgl_akhir]);
    return $pdf->download("invoice_Penggunaandana_{$tgl_awal}_{$tgl_akhir}.pdf");
 }
 public function laporantunggakan(Request $request){
    $idsek        = Session::get('idsekolah');
    $jenis        = $request->jenis;
    $id_kelas     = $request->id_kelas;
    $id_tahun     = $request->id_tahun;
    $kelas        = KelasModel::where('id_sekolahkelas',$idsek)->where('id_kelas',$id_kelas)->first();
    $nmkelas      = $kelas->id_kelas;
        if($jenis=='Bulanan'){
            $pdf = PDF::loadView('operator.laporan.cetaktunggakanbulan',['id_kelas'=>$id_kelas],['id_tahun'=>$id_tahun]);
            return $pdf->download("LaporanTunggakanBB_Kelas_{$nmkelas}.pdf");
        }
        if($jenis=='Bebas'){
            $pdf = PDF::loadView('operator.laporan.tunggakanbebas',['id_kelas'=>$id_kelas],['id_tahun'=>$id_tahun]);
            return $pdf->download("LaporanTuangakanBSB_Kelas_{$nmkelas}.pdf");
        }
}




}
