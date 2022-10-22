<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PembayaranModel;
use App\TarifBebasModel;
use App\InstansiModel;
use App\SiswaModel;
use App\TahunModel;
use App\BulanModel;
use App\BayarBulananModel;
use App\SekolahModel;
use App\RiwayatKelasModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class PembayaranController extends Controller
{
  public function pembayaran(){
    $th = TahunModel::all();
    return view('operator.pembayaran.pembayaran',['th'=>$th]);
  }
  public function hasilcaripembayaran(Request $request){
        $id       = Session::get('idsekolah');
        $idtahun  =$request->idtahun;
        $nis      = $request->nis;
        $countsiswa = SiswaModel::where('nis',$nis)->where('id_sekolahsiswa',$id)->count();
        if($countsiswa > 0){
            $datasiswa = SiswaModel::where('tbl_siswa.nis',$nis)
                         ->where('id_sekolahsiswa',$id)
                         ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')->first();
            $tahun = TahunModel::where('tbl_tahunajaran.id_tahun',$idtahun)
                        ->first();
           $id_kelas = $datasiswa->id_kelas;
           $jenispayment = PembayaranModel::select('tbl_jenispayment.id_jenispayment')
                            ->where('tbl_jenispayment.id_tahun',$idtahun)
                            ->where('tipe','Bulanan')
                            ->where('idsekolahpay',$id)
                            ->join('tarif_bulanan','tarif_bulanan.id_jenispayment','tbl_jenispayment.id_jenispayment')
                            ->join('riwayat_kelas','riwayat_kelas.id_kelas','tarif_bulanan.id_kelas')
                            ->groupBy('id_jenispayment')
                            ->get();
          //tarif BEBAS
          $idkelascheck = RiwayatKelasModel::where('id_tahun',$idtahun)->where('nis',$nis)->count();
          if($idkelascheck > 0){
            $idkl = RiwayatKelasModel::where('id_tahun',$idtahun)->where('nis',$nis)->first();
            $idkelas = $idkl->id_kelas;
          }else{
            $idkelas = $id_kelas;
          }
          $datatarifbebas  = TarifBebasModel::select('tbl_jenispayment.id_jenispayment','tarif_bebas.id_tarifbebas')->where('tbl_jenispayment.tipe','Bebas')
                            ->where('riwayat_kelas.nis',$nis)
                            ->where('riwayat_kelas.id_kelas',$idkelas)
                            ->where('idsekolahbebas',$id)
                            ->where('tarif_bebas.id_tahun',$idtahun)
                            ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','tarif_bebas.id_jenispayment')
                            ->join('riwayat_kelas','riwayat_kelas.id_kelas','tarif_bebas.id_kelas')

                            ->get();
                            return view('operator.pembayaran.hasilcaripembayaran',['ds'=>$datasiswa],['tahun'=>$tahun])
                                    ->with(['jp'=>$jenispayment])
                                    ->with(['tarifbebas'=>$datatarifbebas]); // melempar data ke view
                  }
                  else{
                    return redirect('/pembayaran/pembayaransiswa/')->with('danger','Data tidak tersedia');
                  }



            }
            public function cetakbayarbulanan($id,$nis,$th){
              $idsek = Session::get('idsekolah');
              $idtahun  =$th;
              $nis      = $nis;

              $check = PembayaranModel::where('tbl_jenispayment.id_jenispayment',$id)
                              ->where('riwayat_kelas.nis',$nis)
                              ->where('tbl_jenispayment.id_tahun',$idtahun)
                              ->where('bayar_bulanan.nis',$nis)
                              ->join('tarif_bulanan','tarif_bulanan.id_jenispayment','=','tbl_jenispayment.id_jenispayment')
                              ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                              ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                              ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bulanan.nis')
                              ->join('riwayat_kelas','riwayat_kelas.id_kelas','=','tarif_bulanan.id_kelas')
                              ->join('tbl_kelas','tbl_kelas.id_kelas','=','tarif_bulanan.id_kelas')
                              ->where('tbl_jenispayment.tipe','Bulanan')->count();
              if($check > 0){
                $ds = SiswaModel::where('nis',$nis)
                            ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')->first();

                            $bulanan  = BulanModel::where('tarif_bulanan.id_jenispayment',$id)
                                        ->where('tarif_bulanan.id_kelas',$ds->id_kelas)
                                        ->join('tarif_bulanan','tarif_bulanan.id_bulan','=','tbl_bulan.id_bulan')->get();

                            $bayarbulanan = BayarBulananModel::where('nis',$nis)
                            ->get();

                $tahunajaran = TahunModel::where('id_tahun',$idtahun)
                                ->first();
                $jenispayment = PembayaranModel::where('tbl_jenispayment.id_jenispayment',$id)
                                ->where('riwayat_kelas.nis',$nis)
                                ->where('bayar_bulanan.nis',$nis)
                                ->join('tarif_bulanan','tarif_bulanan.id_jenispayment','=','tbl_jenispayment.id_jenispayment')
                                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                                ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bulanan.nis')
                                ->join('riwayat_kelas','riwayat_kelas.id_kelas','=','tarif_bulanan.id_kelas')
                                ->join('tbl_kelas','tbl_kelas.id_kelas','=','tarif_bulanan.id_kelas')
                                ->where('tbl_jenispayment.tipe','Bulanan')->get();
                $datasekolah = SekolahModel::where('id_sekolah',$idsek)->first();

                                $pdf = PDF::loadView('pdf.cetakbayarbulanan',
                                ['sekolah'=>$datasekolah],
                                ['jp'=>$jenispayment]);

                                return $pdf->download("invoicebulanan_{$nis}_{$id}.pdf");
              }
              else{
                return redirect("/pembayaran/pembayaransiswa")->with('danger','Data bulanan Kosong !!');
              }






            }
            public function cetaktagihanlainnya($id,$nis,$tahun){
                $idsek = Session::get('idsekolah');
                $check = TarifBebasModel::where('tarif_bebas.id_tahun',$tahun)->where('tbl_jenispayment.id_jenispayment',$id)
                                      ->where('tarif_bebas.id_jenispayment',$id)
                                      ->where('bayar_bebas.nis',$nis)
                                      ->join('bayar_bebas','bayar_bebas.id_tarifbebas','=','tarif_bebas.id_tarifbebas')
                                      ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                                      ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bebas.nis')
                                      ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')
                                      ->count();
                if($check > 0){
                  $pembayaran = TarifBebasModel::where('tbl_jenispayment.id_jenispayment',$id)
                                        ->where('tarif_bebas.id_jenispayment',$id)
                                        ->where('bayar_bebas.nis',$nis)
                                        ->join('bayar_bebas','bayar_bebas.id_tarifbebas','=','tarif_bebas.id_tarifbebas')
                                        ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                                        ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bebas.nis')
                                        ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')
                                        ->get();
                                        $datasekolah = SekolahModel::where('id_sekolah',$idsek)->first();
                                        $pdf = PDF::loadView('pdf.cetaktagihanlainnya',['cetak'=>$pembayaran],['sekolah'=>$datasekolah]);
                                        return $pdf->download("invoice_{$nis}_{$id}.pdf");

                }else{
                  return redirect ("/pembayaran/hasilcaripembayaran?idtahun=$tahun&nis=$nis")->with('danger','Tagihan Lainya atau Tagihan bukan bulanan Kosong !!');

                }

              }
              public function cetaksemuatagihanlainnya($tahun,$nis){
                $idsek = Session::get('idsekolah');
                $cek        = TarifBebasModel::where('tarif_bebas.id_tahun',$tahun)->where('bayar_bebas.nis',$nis)
                                      ->join('bayar_bebas','bayar_bebas.id_tarifbebas','=','tarif_bebas.id_tarifbebas')
                                      ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                                      ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bebas.nis')
                                      ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')
                                      ->count();
                             if($cek > 0){
                               $pembayaran = TarifBebasModel::where('bayar_bebas.nis',$nis)
                                                     ->join('bayar_bebas','bayar_bebas.id_tarifbebas','=','tarif_bebas.id_tarifbebas')
                                                     ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                                                     ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bebas.nis')
                                                     ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')
                                                     ->get();
                                                     $datasekolah = SekolahModel::where('id_sekolah',$idsek)->first();
                                                     $pdf = PDF::loadView('pdf.cetaksemuatagihanlainnya',['cetak'=>$pembayaran],['sekolah'=>$datasekolah]);
                                                     return $pdf->download("invoice_{$nis}_{$tahun}.pdf");
                             }
                             else{
                               return redirect ("/pembayaran/hasilcaripembayaran?idtahun=$tahun&nis=$nis")->with('danger','Belum ada Pembayaran');
                             }



              }


}
