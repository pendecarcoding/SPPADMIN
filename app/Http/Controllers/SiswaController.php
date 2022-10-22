<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PengeluaranModel;
use App\PosModel;
use App\SiswaModel;
use App\KelasModel;
use App\RiwayatKelasModel;
use App\PaymentModel;
use App\PemasukanModel;
use App\BayarBulananModel;
use App\BayarBebasModel;
use App\JenispengeluaranModel;
use App\TahunModel;
use PDF;
use Session;
use Excel;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
class SiswaController extends Controller
{
  public function siswa(){
    $id    = Session::get('idsekolah');
    $data  = SiswaModel::where('id_sekolahsiswa',$id)
            ->where('statussiswa','Aktif')
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();
    $thun  = TahunModel::all();
    $kls   = KelasModel::where('id_sekolahkelas',$id)->get();
    return view('operator.siswa.siswa',['data'=>$data],['tahun'=>$thun])->with(['kls'=>$kls]);
  }

  public function siswaedit($nis=null){
    $id    = Session::get('idsekolah');
    $nis   = base64_decode($nis);
    $check = SiswaModel::where('nis',$nis)->where('id_sekolahsiswa',$id)->count();
    if($check > 0){
      $data  = SiswaModel::where('id_sekolahsiswa',$id)
                ->where('statussiswa','Aktif')
                ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
                ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
                ->orderBy('kelas','ASC')
                ->orderBy('nama','ASC')
                ->get();

      $e  = SiswaModel::where('id_sekolahsiswa',$id)
                ->where('nis',$nis)
                ->where('statussiswa','Aktif')
                ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
                ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
                ->first();
      $thun  = TahunModel::all();
      $kls   = KelasModel::where('id_sekolahkelas',$id)->get();
      return view('operator.siswa.siswaedit',['data'=>$data],['tahun'=>$thun])->with(['kls'=>$kls])->with(['e'=>$e]);

    }else{
      return redirect('/datamaster/datasiswa')->with('danger','Data tidak tersedia');
    }
    }


  public function tambahsiswa(Request $request){
    $id    = Session::get('idsekolah');
    $check = SiswaModel::where('nis',$request->nis)->where('id_sekolahsiswa',$id)->count();
    if($check > 0){
        return back()->with('danger','Gagal dikarenakan NIS duplikat');
    }
    else{
      if ($request->hasfile('gambar') AND !empty($request->gambar)) {
        $request->validate([
           'gambar' => 'required|mimes:jpg,png|max:2048'
        ]);
        $photo = base64_encode(file_get_contents($request->file('gambar')));
        $photo = str_replace('data:image/png;base64,', '', $photo);
        $photo = str_replace(' ', '+', $photo);
        $img   = base64_decode($photo);
        $file  = uniqid() . '.png';
      }
      else{
        $name = 'admin.png';
      }

      $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'tpt_lahir' => $request->tempatlahir,
                'tgl_lahir' => $request->tl,
                'nama_ibu' => $request->namaibu,
                'id_kelas' => $request->idkelas,
                'foto' => $file,
                'alamat' => $request->alamat,
                'id_sekolahsiswa' => $id,
                'idtahunmasuksiswa' => $request->idtahun,
                'statussiswa' => 'Aktif',
              ];


      $actions = SiswaModel::insert($data);
      if($actions){
        $riwayatkelas = [
                      'nis' => $request->nis,
                      'id_sekolah' => $id,
                      'id_kelas' => $request->idkelas,
                      'id_tahun' => $request->idtahun,
                      'keterangan' => 'Tahun Masuk'
                ];

        $actionr = RiwayatKelasModel::insert($riwayatkelas);
        if($actionr){
          return redirect('/datamaster/datasiswa')->with('success','Data berhasil di simpan');
        }else{
          return back()->with('danger','Data gagal disimpan');
        }

      }



    }

 }

 public function updatesiswa(Request $request){
   $id    = Session::get('idsekolah');
   $check = SiswaModel::where('nis',$request->nis)->where('id_sekolahsiswa',$id)->where('id_siswa',$request->idsiswa)->count();
   if($check > 0){
     if ($request->hasfile('gambar') AND !empty($request->gambar)) {
       $request->validate([
          'gambar' => 'required|mimes:jpg,png|max:2048'
       ]);
        $file = $request->file('gambar');
        $name = time().$file->getClientOriginalName();
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('images/siswa/' .$name));
        }
      else{
        $name = $request->nmfoto;
      }

      $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'tpt_lahir' => $request->tempatlahir,
                'tgl_lahir' => $request->tl,
                'nama_ibu' => $request->namaibu,
                'id_kelas' => $request->idkelas,
                'foto' => $name,
                'alamat' => $request->alamat,
                'id_sekolahsiswa' => $id,
                'idtahunmasuksiswa' => $request->idtahun,
                'statussiswa' => 'Aktif',
              ];
     $riwayatkelas = [
               'nis' => $request->nis,
               'id_kelas' => $request->idkelas,
               'id_tahun' => $request->idtahun,
               'keterangan' => 'Tahun Masuk'
               ];
               $riwayatkelas2 = [
                         'nis' => $request->nis,
                         'id_kelas' => $request->idkelas,
                         ];

      $action  = SiswaModel::where('nis',$request->id)->where('id_sekolahsiswa',$id)->update($data);
      $checkr  = RiwayatKelasModel::where('id_tahun',$request->id_tahun)
                ->where('nis',$request->id)
                ->where('id_sekolah',$id)
                ->where('keterangan','Tahun Masuk')
                ->count();
      if($checkr > 1){
        $riwayatkelas = [
                  'nis' => $request->nis,
                  'id_kelas' => $request->idkelas
                  ];
        $action = RiwayatKelasModel::where('nis',$request->id)->where('id_sekolah',$id)->update($riwayatkelas);

      }
      else{
        $action = RiwayatKelasModel::where('nis',$request->id)->where('id_sekolah',$id)->update($riwayatkelas2);
      }
      return redirect('/datamaster/datasiswa')->with('success','Data berhasil di update');

   }else{
     $checknis = SiswaModel::where('nis',$request->nis)->where('id_sekolahsiswa',$id)->count();
     if($checknis > 0)
     return back()->with('danger','NIS tidak boleh duplikat !!!');
     else
     if ($request->hasfile('gambar') AND !empty($request->gambar)) {
       $request->validate([
          'gambar' => 'required|mimes:jpg,png|max:2048'
       ]);
        $file = $request->file('gambar');
        $name = time().$file->getClientOriginalName();
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('images/siswa/' .$name));
        }
      else{
        $name = $request->nmfoto;
      }

      $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'tpt_lahir' => $request->tempatlahir,
                'tgl_lahir' => $request->tl,
                'nama_ibu' => $request->namaibu,
                'id_kelas' => $request->idkelas,
                'foto' => $name,
                'alamat' => $request->alamat,
                'id_sekolahsiswa' => $id,
                'idtahunmasuksiswa' => $request->idtahun,
                'statussiswa' => 'Aktif',
              ];
     $riwayatkelas = [
               'nis' => $request->nis,
               'id_kelas' => $request->idkelas,
               'id_tahun' => $request->idtahun,
               'keterangan' => 'Tahun Masuk'
               ];
               $riwayatkelas2 = [
                         'nis' => $request->nis,
                         'id_kelas' => $request->idkelas,
                         ];

      $action  = SiswaModel::where('nis',$request->id)->where('id_sekolahsiswa',$id)->update($data);
      $checkr  = RiwayatKelasModel::where('id_tahun',$request->id_tahun)
                ->where('nis',$request->id)
                ->where('id_sekolah',$id)
                ->where('keterangan','Tahun Masuk')
                ->count();
      if($checkr > 1){
        $riwayatkelas = [
                  'nis' => $request->nis,
                  'id_kelas' => $request->idkelas
                  ];
        $action = RiwayatKelasModel::where('nis',$request->id)->where('id_sekolah',$id)->update($riwayatkelas);

      }
      else{
        $action = RiwayatKelasModel::where('nis',$request->id)->where('id_sekolah',$id)->update($riwayatkelas2);
      }
      return redirect('/datamaster/datasiswa')->with('success','Data berhasil di update');
   }




}

 public function delsis($id=null){
    $idsek      = Session::get('idsekolah');
    $checkbb    = BayarBulananModel::where('nis',$id)->where('idsekolahbb',$idsek)->count();
    $checkbs    = BayarBebasModel::where('nis',$id)->where('idsekolahbe',$idsek)->count();
    if($checkbb > 0 OR $checkbs > 0){
      return redirect ('/datamaster/datasiswa')->with('danger','Data tidak bisa dihapus dikarenakan terdapat pembayaran pada siswa tersebut');
    }else{
      $action     = RiwayatKelasModel::where('nis',$id)->where('id_sekolah',$idsek)->delete();
      $action     = SiswaModel::where('nis',$id)->where('id_sekolahsiswa',$idsek)->delete();
      return redirect ('/datamaster/datasiswa')->with('success','Data berhasil dihapus');
    }

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
  $data  = JenispengeluaranModel::where('idkatsekolah',$id)->where('tbl_tahunajaran.status','Y')
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
      $datakategori  = JenispengeluaranModel::all();
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
            $datakategori  = JenispengeluaranModel::all();
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

            public function importsiswa(Request $request){
            $request->validate([
               'import_file' => 'required|mimes:xlsx,xlsm,xls|max:2048'
            ]);

           $path = $request->file('import_file')->getRealPath();
           $data = Excel::load($path)->get();
           $gagal    = 0;
           $sukses   = 0;
           if($data->count()){
               foreach ($data as $key => $value) {

                 $id       = Session::get('idsekolah');
                 $checksis = SiswaModel::where('nis',$value->nis)->where('id_sekolahsiswa',$id)->count();
                 $rkelas   = RiwayatKelasModel::where('nis',$value->nis)->where('id_sekolah',$id)->count();
                 $chkkelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas',$value->kelas)->count();
                 $chktahun = TahunModel::where('tahun',$value->tahun_penerapan)->count();

                 if($checksis > 0 OR $chkkelas < 1 OR $chktahun < 1){
                   $gagal++;
                 }else{
                   $id_kelas = KelasModel::where('id_sekolahkelas',$id)->where('kelas',$value->kelas)->first();
                   $id_tahun = TahunModel::where('tahun',$value->tahun_penerapan)->first();
                   $sukses++;
                   $arr[] = [
                      'nis' => $value->nis,
                     'nama' => $value->nama,
                     'tpt_lahir' => $value->tempat_lahir,
                     'tgl_lahir' => $value->tanggal_lahir,
                     'nama_ibu' => $value->ibu_kandung,
                     'id_kelas' => $id_kelas->id_kelas,
                     'foto' => 'admin.png',
                     'alamat' => $value->alamat,
                     'id_sekolahsiswa' => $id,
                     'idtahunmasuksiswa' => $id_tahun->id_tahun,
                     'statussiswa' => 'Aktif'
                    ];
                    if($rkelas > 0)
                    {
                    $ark[]=[
                      'nis' => $value->nis,
                      'id_kelas' => $id_kelas->id_kelas,
                      'id_tahun' => $id_tahun->id_tahun
                    ];
                    $action = RiwayatKelasModel::where('nis',$value->nis)->where('id_sekolah',$id)->update($ark);
                  }
                  else{
                    $ark[]=[
                      'nis' => $value->nis,
                      'id_sekolah' => $id,
                      'id_kelas' => $id_kelas->id_kelas,
                      'id_tahun' => $id_tahun->id_tahun,
                      'Keterangan'=>'Tahun Masuk'
                    ];

                  }

                 }


               }

               if(!empty($arr)){
                   SiswaModel::insert($arr);
                   RiwayatKelasModel::insert($ark);
                   $total = $key+1;


               }
               else{
                 $total = $key+1;
               }
           }

           return back()->with('success', "Berhasil: $sukses | Gagal: $gagal | Dari: $total");
       }





 }
