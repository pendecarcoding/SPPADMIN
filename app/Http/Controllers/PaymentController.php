<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\InstansiModel;
use App\PaymentModel;
use App\KelasModel;
use App\BulanModel;
use App\BayarBulananModel;
use App\BayarBebasModel;
use App\PembayaranModel;
use App\SiswaModel;
use App\PosModel;
use App\RiwayatKelasModel;
use App\TarifBebasModel;
use App\TarifBulanModel;
use App\TarifBulanKhususModel;
use App\TahunModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class PaymentController extends Controller
{
  public function jenis(){
    $id   = Session::get('idsekolah');
    $pos  = PosModel::where('id_sekolahpos',$id)->get();
    $data = PaymentModel::where('idsekolahpay',$id)
                  ->where('tbl_tahunajaran.status','Y')
                  ->where('tbl_jenispayment.jenis','umum')
                  ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                  ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->get();
    $th   = TahunModel::where('status','Y')->get();
    return view('operator.jenispembayaran.jenis',['data'=>$data],['pos'=>$pos])->with(['th'=>$th]);
  }
  public function tarifkhusus(){
    $id   = Session::get('idsekolah');
    $pos  = PosModel::where('id_sekolahpos',$id)->get();
    $data = PaymentModel::where('idsekolahpay',$id)
                  ->where('tbl_tahunajaran.status','Y')
                  ->where('tbl_jenispayment.jenis','khusus')
                  ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                  ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->get();
    $th   = TahunModel::where('status','Y')->get();
    return view('operator.jenispembayaran.jeniskhusus',['data'=>$data],['pos'=>$pos])->with(['th'=>$th]);
  }
  public function tambahpayment(Request $request){
    $id   = Session::get('idsekolah');
              $data = [
                    'id_pos' => $request->idpos,
                    'id_tahun' => $request->idtahun,
                    'namapayment' => $request->nama,
                    'tipe' => $request->tipe,
                    'rule' => 0,
                    'jenis' => 'umum',
                    'idsekolahpay' => $id
                ];

                // di bawah ini proses insert ke tabel kendaraan

                $store = PaymentModel::insert($data);



                 return redirect('/payment/jenis_pay')->with('success','Data berhasil di simpan');

            }

            public function tambahpaymentkhusus(Request $request){
              $id   = Session::get('idsekolah');
                        $data = [
                              'id_pos' => $request->idpos,
                              'id_tahun' => $request->idtahun,
                              'namapayment' => $request->nama,
                              'tipe' => $request->tipe,
                              'rule' => 0,
                              'jenis' => 'khusus',
                              'idsekolahpay' => $id
                          ];

                          // di bawah ini proses insert ke tabel kendaraan

                          $store = PaymentModel::insert($data);



                           return back()->with('success','Data berhasil di simpan');

                      }
            public function deletepay($id=null){

              $checkbebas  = TarifBebasModel::where('id_jenispayment',$id)->count();
              $checkbulan  = TarifBulanModel::where('id_jenispayment',$id)->count();
              if($checkbebas > 0){
              return redirect('/payment/jenis_pay')->with('danger','Data Tersebut telah telah terset tarif');
              }
              else if($checkbulan > 0){
                return redirect('/payment/jenis_pay')->with('danger','Data Tersebut telah telah terset tarif');

              }
              else{
                $action = PaymentModel::where('id_jenispayment',$id)->delete();
                return redirect('/payment/jenis_pay')->with('success','Data berhasil dihapus');
              }

            }
            public function deletepaykhusus($id=null){

              $checkbebas  = TarifBebasModel::where('id_jenispayment',$id)->count();
              $checkbulan  = TarifBulanModel::where('id_jenispayment',$id)->count();
              if($checkbebas > 0){
              return back()->with('danger','Data Tersebut telah telah terset tarif');
              }
              else if($checkbulan > 0){
                return back()->with('danger','Data Tersebut telah telah terset tarif');

              }
              else{
                $action = PaymentModel::where('id_jenispayment',$id)->delete();
                return back()->with('success','Data berhasil dihapus');
              }

            }


      //Bulanan
      public function bulanan($idp=null){
        $idp  = base64_decode($idp);
        $id   = Session::get('idsekolah');
        $data = PaymentModel::where('id_jenispayment',$idp)
                      ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                      ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->first();
                      $datakelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas','!=','Tamat')->get();
                      $databulan      = BulanModel::all();

        return view('operator.jenispembayaran.bulan',['bln'=>$databulan],['kls'=>$datakelas])->with(['data'=>$data]);
      }
      public function bulanancari($idp,$kelas,$tahun){
        if(empty($idp) OR empty($kelas) OR empty($tahun) ){
          return redirect('/payment/jenis_pay')->with('danger','Data tidak tersedia');
        }
        $idp  = base64_decode($idp);
        $kelas = base64_decode($kelas);
        $tahun = base64_decode($tahun);
        $id   = Session::get('idsekolah');
        $data = PaymentModel::where('id_jenispayment',$idp)
                      ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                      ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->first();
                      $datakelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas','!=','Tamat')->get();
                      $databulan      = BulanModel::all();
        $tarif = TarifBulanModel::where('id_jenispayment',$idp)->where('id_kelas',$kelas)->where('idsekolahtarif',$id)->get();

        return view('operator.jenispembayaran.bulancari',['bln'=>$databulan],['kls'=>$datakelas])->with(['data'=>$data])->with(['kelas'=>$kelas]);
      }

      public function jenisedit($idp=null){
        $idp  = base64_decode($idp);
        $id   = Session::get('idsekolah');
        $pos  = PosModel::where('id_sekolahpos',$id)->get();
        $data = PaymentModel::where('idsekolahpay',$id)
                ->where('tbl_tahunajaran.status','Y')
                ->where('tbl_jenispayment.jenis','umum')
                ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->get();
        $th   = TahunModel::where('status','Y')->get();
        $e    = PaymentModel::where('id_jenispayment',$idp)->where('idsekolahpay',$id)->first();
        return view('operator.jenispembayaran.jenisedit',['data'=>$data],['pos'=>$pos])->with(['th'=>$th])->with(['e'=>$e]);
      }
      public function jeniskhususedit($idp=null){
        $idp  = base64_decode($idp);
        $id   = Session::get('idsekolah');
        $pos  = PosModel::where('id_sekolahpos',$id)->get();
        $data = PaymentModel::where('idsekolahpay',$id)
                ->where('tbl_tahunajaran.status','Y')
                ->where('tbl_jenispayment.jenis','khusus')
                ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->get();
        $th   = TahunModel::where('status','Y')->get();
        $e    = PaymentModel::where('id_jenispayment',$idp)->where('idsekolahpay',$id)->first();
        return view('operator.jenispembayaran.jeniskhususedit',['data'=>$data],['pos'=>$pos])->with(['th'=>$th])->with(['e'=>$e]);
      }

      public function updatepayment(Request $request){
        $id   = Session::get('idsekolah');
        $checkbb = TarifBulanModel::where('id_jenispayment',$request->id)->count();
        $checkbs = TarifBebasModel::where('id_jenispayment',$request->id)->count();
        if($checkbb > 0 OR $checkbs > 0){
          return redirect('/payment/jenis_pay')->with('danger','Data sudah di set tarif !!!, Aksi Edit tidak berfungsi');
        }
        else{
          $data = [
                'id_pos' => $request->idpos,
                'id_tahun' => $request->idtahun,
                'namapayment' => $request->nama,
                'tipe' => $request->tipe,
                'rule' => 0,
                'jenis' => 'umum',
                'idsekolahpay' => $id
            ];

            // di bawah ini proses insert ke tabel kendaraan

            $store = PaymentModel::where('id_jenispayment',$request->id)->update($data);



             return redirect('/payment/jenis_pay')->with('success','Data berhasil di update');

        }

                }


                public function updatepaymentkhusus(Request $request){
                  $id   = Session::get('idsekolah');
                  $checkbb = TarifBulanModel::where('id_jenispayment',$request->id)->count();
                  $checkbs = TarifBebasModel::where('id_jenispayment',$request->id)->count();
                  if($checkbb > 0 OR $checkbs > 0){
                    return back()->with('danger','Data sudah di set tarif !!!, Aksi Edit tidak berfungsi');
                  }
                  else{
                    $data = [
                          'id_pos' => $request->idpos,
                          'id_tahun' => $request->idtahun,
                          'namapayment' => $request->nama,
                          'tipe' => $request->tipe,
                          'rule' => 0,
                          'jenis' => 'khusus',
                          'idsekolahpay' => $id
                      ];

                      // di bawah ini proses insert ke tabel kendaraan

                      $store = PaymentModel::where('id_jenispayment',$request->id)->update($data);



                       return back()->with('success','Data berhasil di update');

                  }

                          }


                public function tambahtarfibulan(Request $request){
                  $idbulan    = $request->idbulan;
                  $idkelas    = base64_decode($request->idkelas);
                  $idpayment  = $request->id;
                  $tarifbulan = $request->tarifbulan;
                  $idtahun    = $request->idtahun;
                  $idsekolah  = $request->idsekolah;
                  $siswa      = SiswaModel::where('id_kelas',$idkelas)->where('id_sekolahsiswa',$idsekolah)->get();
                  $idp        = base64_encode($idpayment);
                  $idkl       = base64_encode($idkelas);
                  $idth       = base64_encode($idtahun);
                  foreach( $idbulan as $key => $n ) {
                    $check = TarifBulanModel::where('id_jenispayment',$idpayment)
                              ->where('id_bulan',$n)
                              ->where('id_kelas',$idkelas)
                              ->where('idsekolahtarif',$request->idsekolah)->count();

                    if($check > 0){
                      $data = [
                            'id_jenispayment' => $idpayment,
                            'id_bulan' => $n,
                            'id_kelas' => $idkelas,
                            'harga_tarif' => preg_replace('/[^0-9]/','',$tarifbulan[$key]),
                            'id_tahun' => $idtahun,
                            'idsekolahtarif' => $request->idsekolah
                        ];

                        // di bawah ini proses insert ke tabel kendaraan

                        $store = TarifBulanModel::where('id_tarifbulan',$request->idtarif[$key])->update($data);
                    }
                    else{
                      $data = [
                            'id_jenispayment' => $idpayment,
                            'id_bulan' => $n,
                            'id_kelas' => $idkelas,
                            'harga_tarif' => preg_replace('/[^0-9]/','',$tarifbulan[$key]),
                            'id_tahun' => $idtahun,
                            'idsekolahtarif' => $request->idsekolah
                        ];

                        // di bawah ini proses insert ke tabel kendaraan

                        $store = TarifBulanModel::insert($data);
                    }



                    }



                       return redirect('/payment/bulanancari/'.$idp.'/'.$idkl.'/'.$idth);

                  }

        //bebas
        public function bebas($idp=null){
          $idp  = base64_decode($idp);
          $id   = Session::get('idsekolah');
          $data = PaymentModel::where('id_jenispayment',$idp)
                        ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                        ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->first();
                        $datakelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas','!=','Tamat')->get();

          return view('operator.jenispembayaran.bebas',['kls'=>$datakelas])->with(['data'=>$data]);
        }
        public function bebascari($idp,$kelas){
          if(empty($idp) OR empty($kelas)){
            return redirect('/payment/jenis_pay')->with('danger','Data tidak tersedia');
          }
          $idp  = base64_decode($idp);
          $id   = Session::get('idsekolah');
          $data = PaymentModel::where('id_jenispayment',$idp)
                        ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                        ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->first();
                        $datakelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas','!=','Tamat')->get();
          $checktarif = TarifBebasModel::where('id_jenispayment',$idp)->where('id_kelas',$kelas)->where('idsekolahbebas',$id)->count();
          if($checktarif > 0){
            $check = TarifBebasModel::where('id_jenispayment',$idp)->where('id_kelas',$kelas)->where('idsekolahbebas',$id)->first();
            $id_tarifbebas = $check->id_tarifbebas;
            $tarifbebas    = $check->tarifbebas;
          }
          else{
            $id_tarifbebas = '';
            $tarifbebas    = '';
          }
          return view('operator.jenispembayaran.bebascari',['kls'=>$datakelas])->with(['data'=>$data])->with(['kelas'=>$kelas])
                   ->with(['id_tarifbebas'=>$id_tarifbebas])
                   ->with(['tarifbebas'=>$tarifbebas]);
        }
        public function tambahtarifbebas(Request $request){
          $id = Session::get('idsekolah');
          if(!empty($request->idtarif)){
            $data = [
              'id_jenispayment'=>$request->id,
              'id_kelas'=>$request->idkelas,
              'tarifbebas'=>$request->tarif,
              'id_tahun'=>$request->idtahun,
              'idsekolahbebas'=>$id
            ];
            $idencode = base64_encode($request->id);
            $action = TarifBebasModel::where('id_tarifbebas',$request->idtarif)->update($data);
            return redirect('/payment/bebascari/'.$idencode.'/'.$request->idkelas)->with('success','Data berhasil diupdate');
          }
          else{
            $data = [
              'id_jenispayment'=>$request->id,
              'id_kelas'=>$request->idkelas,
              'tarifbebas'=>$request->tarif,
              'id_tahun'=>$request->idtahun,
              'idsekolahbebas'=>$id
            ];
            $idencode = base64_encode($request->id);
            $action = TarifBebasModel::insert($data);
            return redirect('/payment/bebascari/'.$idencode.'/'.$request->idkelas)->with('success','Data berhasil disimpan');
          }
        }

        public function viewbayarspp($id,$nis,$th){
              $idtahun  =$th;
              $nis      = $nis;
              $chkds    = SiswaModel::where('nis',$nis)
                          ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')->count();
              $ds       = SiswaModel::where('nis',$nis)
                          ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')->first();
              $chkbulanan  = BulanModel::where('tarif_bulanan.id_jenispayment',$id)
                          ->where('tarif_bulanan.id_kelas',$ds->id_kelas)
                          ->join('tarif_bulanan','tarif_bulanan.id_bulan','=','tbl_bulan.id_bulan')->count();
              $chktah = TahunModel::where('id_tahun',$idtahun)->count();
              if($chkds == '0' OR $chkbulanan == '0' OR $chktah == '0'){
                return redirect('/pembayaran/pembayaransiswa')->with('danger','Data tidak tersedia');
              }
              else{
                $ds = SiswaModel::where('nis',$nis)
                            ->join('tbl_kelas','tbl_kelas.id_kelas','=','tbl_siswa.id_kelas')->first();
                            $idsek      = Session::get('idsekolah');
                            $idkelascheck = RiwayatKelasModel::where('id_tahun',$idtahun)->where('nis',$nis)->count();
                            if($idkelascheck > 0){
                              $idkl = RiwayatKelasModel::where('id_tahun',$idtahun)->where('nis',$nis)->first();
                              $idkelas = $idkl->id_kelas;
                            }else{
                              $idkelas = $ds->id_kelas;
                            }

                            $bulanan  = BulanModel::where('tarif_bulanan.id_jenispayment',$id)
                                        ->where('tarif_bulanan.id_tahun',$idtahun)
                                        ->where('tarif_bulanan.id_kelas',$idkelas)
                                        ->join('tarif_bulanan','tarif_bulanan.id_bulan','=','tbl_bulan.id_bulan')->get();
                                        $bayarbulanan = BayarBulananModel::where('nis',$nis)
                            ->get();

                $tahunajaran = TahunModel::where('id_tahun',$idtahun)
                                ->first();
                $jenispayment = PembayaranModel::where('id_jenispayment',$id)
                                ->where('tipe','Bulanan')->where('id_tahun',$idtahun)->first();

                    return view('operator.pembayaran.viewbayarspp',['jp'=>$jenispayment],['th'=>$tahunajaran])
                    ->with(['ds'=>$ds])
                    ->with(['jb'=>$bulanan])
                    ->with(['bb'=>$bayarbulanan]); // melempar data ke view

              }



            }
            public function bayarbulanan($id,$nis,$hrga,$idp,$th){
              $idsekolah = Session::get('idsekolah');
              $data = [
                    'id_tarifbulan' => $id,
                    'nis' => $nis,
                    'jumlah_bayar' =>$hrga,
                    'tanggal' =>date('Y-m-d'),
                    'status' =>'Y',
                    'idsekolahbb' =>$idsekolah
                ];

                // di bawah ini proses insert ke tabel kendaraan

                $store = BayarBulananModel::insert($data);

                return redirect ("/pembayaran/bulanan/$idp/$nis/$th");

            }

            public function bayarbebas(Request $request){
              $idtahun  =$request->idtahun;
              $nis      = $request->nis;
              $id       = Session::get('idsekolah');
              $check = BayarBebasModel::where('nis',$nis)
                                      ->where('id_tarifbebas',$request->id_tarifbebas)->count();
              if($check <> ''){
                $data = [
                  'nis'=>$request->nis,
                  'id_tarifbebas'=>$request->idtarifbebas,
                  'jumlah_bayar'=>$request->jumlahbayar,
                  'tanggal'=>date('Y-m-d'),
                  'status'=>'Y'

                ];
                $store = BayarBebasModel::update($data)->where('nis',$nis)->where('id_tarifbebas',$request->idtarifbebas);

              }
              else{
                $data = [
                  'nis'=>$request->nis,
                  'id_tarifbebas'=>$request->idtarifbebas,
                  'jumlah_bayar'=>$request->jumlahbayar,
                  'tanggal'=>date('Y-m-d'),
                  'status'=>'Y',
                  'idsekolahbe'=>$id

                ];
                $store = BayarBebasModel::insert($data);
              }



              return redirect ("pembayaran/hasilcaripembayaran?idtahun=$idtahun&nis=$nis");


            }

            //Bulanan khusus
            public function bulanankhusus($idp=null){
              $idp  = base64_decode($idp);
              $id   = Session::get('idsekolah');
              $data = PaymentModel::where('id_jenispayment',$idp)
                            ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                            ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->first();
                            $datakelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas','!=','Tamat')->get();
                            $databulan      = BulanModel::all();

              return view('operator.jenispembayaran.bulankhusus',['bln'=>$databulan],['kls'=>$datakelas])->with(['data'=>$data]);
            }

            public function bulanancarikhusus($idp,$kelas,$tahun){
              if(empty($idp) OR empty($kelas) OR empty($tahun) ){
                return redirect('/payment/jenis_pay')->with('danger','Data tidak tersedia');
              }
              $idp  = base64_decode($idp);
              $kelas = base64_decode($kelas);
              $tahun = base64_decode($tahun);
              $id   = Session::get('idsekolah');
              $data = PaymentModel::where('id_jenispayment',$idp)
                            ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','=','tbl_jenispayment.id_tahun')
                            ->join('tbl_pos','tbl_pos.id_pos','=','tbl_jenispayment.id_pos')->first();
                            $datakelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas','!=','Tamat')->get();
                            $databulan      = BulanModel::all();
              $e     = TarifBulanKhususModel::where('id_jenispayment',$idp)
                           ->where('id_kelas',$kelas)
                           ->where('id_sekolahtarif',$id)
                           ->first();
              $tarif = TarifBulanKhususModel::where('id_jenispayment',$idp)->where('id_kelas',$kelas)->where('id_sekolahtarif',$id)->get();

              return view('operator.jenispembayaran.bulancarikhusus',['bln'=>$databulan],['kls'=>$datakelas])->with(['data'=>$data])
                        ->with(['kelas'=>$kelas])
                        ->with(['e'=>$e]);
            }

            public function tambahtarfibulankhusus(Request $request){
              $idbulan    = $request->idbulan;
              $idkelas    = base64_decode($request->idkelas);
              $idpayment  = $request->id;
              $tarifbulan = $request->tarifbulan;
              $idtahun    = $request->idtahun;
              $idsekolah  = $request->idsekolah;
              $siswa      = SiswaModel::where('id_kelas',$idkelas)->where('id_sekolahsiswa',$idsekolah)->get();
              $idp        = base64_encode($idpayment);
              $idkl       = base64_encode($idkelas);
              $idth       = base64_encode($idtahun);
              $kb         = $request->keb;
              $kbimplode  = implode(",",$kb);
              foreach( $idbulan as $key => $n ) {
                $check = TarifBulanKhususModel::where('id_jenispayment',$idpayment)
                          ->where('id_bulan',$n)
                          ->where('id_kelas',$idkelas)
                          ->where('id_sekolahtarif',$request->idsekolah)
                          ->where('id_kebijakan',$kbimplode)
                          ->count();

                if($check > 0){
                  $data = [
                        'id_jenispayment' => $idpayment,
                        'id_bulan' => $n,
                        'id_kelas' => $idkelas,
                        'harga_tarif' => preg_replace('/[^0-9]/','',$tarifbulan[$key]),
                        'id_tahun' => $idtahun,
                        'id_sekolahtarif' => $request->idsekolah,
                        'id_kebijakan' => $kbimplode
                    ];

                    // di bawah ini proses insert ke tabel kendaraan

                    $store = TarifBulanKhususModel::where('id_tarifbulankhusus',$request->idtarif[$key])->update($data);
                }
                else{
                  $data = [
                        'id_jenispayment' => $idpayment,
                        'id_bulan' => $n,
                        'id_kelas' => $idkelas,
                        'harga_tarif' => preg_replace('/[^0-9]/','',$tarifbulan[$key]),
                        'id_tahun' => $idtahun,
                        'id_sekolahtarif' => $request->idsekolah,
                        'id_kebijakan' => $kbimplode
                    ];

                    // di bawah ini proses insert ke tabel kendaraan

                    $store = TarifBulanKhususModel::insert($data);
                }



                }



                   return redirect('/payment/bulanancarikhusus/'.$idp.'/'.$idkl.'/'.$idth);

              }



}
