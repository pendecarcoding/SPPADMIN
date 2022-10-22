<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WkRequest;
use App\PengaturanModel;
use App\PosModel;
use App\KelasModel;
use App\SiswaModel;
use App\PaymentModel;
use App\GuruModel;
use App\WkModel;
use App\TahunModel;
use PDF;
use Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
class KelasController extends Controller
{
  public function deletewalikelas($id){
    try {
      $act = WkModel::where('id',$id)->delete();
      return back()->with('success','Data berhasil dihapus');
    } catch (\Exception $e) {
      return back()->with('danger',$e->getMessage());
    }

  }
  public function generateakses($id)
  { $akses = uniqid();
    $enc   = base64_encode($akses);
    try {
      $d = [
        'akses'=>'Y',
        'kode_akses'=>$enc
      ];
      $a = WkModel::where('id',$id)->update($d);
      if($a){
        $wk = WkModel::where('id',$id)
              ->join('tbl_guru','tbl_guru.id_guru','tbl_walikelas.id_guru')
              ->first();
        $d = GuruModel::where('id_guru',$wk->id_guru)->first();
        $data =[
            'username'=>$d->email,
            'password'=>md5($akses),
            'nama'=>$d->nama_guru,
            'jabatan'=>'GURU',
            'nohpuser'=>$d->nohp,
            'idsekolah'=>$d->id_sekolah,
            'level'=>'walikelas',
            'foto'=>'admin.png',
            'colour'=>'#587184',
            'created_at'=>now(),
            'updated_at'=>now()
        ];
        $ac = PengaturanModel::insert($data);
      }
      return back()->with('success','Akses diberikan');
    } catch (\Exception $e) {
      return back()->with('danger',$e->getMessage());
    }

  }
  public function datawalikelas(){
    $id    = Session::get('idsekolah');
    $data  = DB::select('select * FROM view_walikelas');
    $guru  = GuruModel::all();
    $kelas = KelasModel::all();
    $tahun = TahunModel::all();
    return view('operator.kelas.walikelas',compact('data','kelas','guru','tahun'));
  }
  public function addwalikelas(WkRequest $r){
      try {
        $d=[
          'id_guru'=>$r->id_guru,
          'id_kelas'=>$r->id_kelas,
          'id_tahun'=>$r->id_tahun,
          'akses'=>'N',
          'kode_akses'=>'',
          'id_sekolah'=>Session::get('idsekolah'),
        ];
        $a = WkModel::insert($d);
        return back()->with('success','Data berhasil disimpan');
      }catch (\Exception $e) {
        return back()->with('danger',$e->getMessage());
      }

  }
  public function kelas(){
    $id   = Session::get('idsekolah');
    $data = KelasModel::where('id_sekolahkelas',$id)
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_kelas.id_sekolahkelas')
            ->orderBy('kelas','ASC')
            ->get();
    return view('operator.kelas.kelas',['data'=>$data]);
  }
  public function tambahkelas(Request $request){
    $id             = Session::get('idsekolah');
    $checknamakelas = KelasModel::where('id_sekolahkelas',$id)
                      ->where('kelas',$request->kls)->count();
    if($checknamakelas > 0){
      return back()->with('danger', 'Nama kelas sudah tersedia !!!, Masukan dengan nama kelas lainnya');
    }else{
      $data = [
            'kelas' => $request->kls,
            'id_sekolahkelas' => $id
      ];
      $action = KelasModel::insert($data);
      return redirect('/datamaster/datakelas')->with('success','Data berhasil disimpan');
    }


  }
  public function delkelas($id=null){
    $check  = SiswaModel::where('id_kelas',$id)->count();
    if($check > 0 ){
      return redirect('/datamaster/datakelas')->with('danger','Gagal !!! Data kelas berelasi dengan data Siswa');
    }
    else{
      $action = KelasModel::where('id_kelas',$id)->delete();
      return redirect('/datamaster/datakelas')->with('success','Data berhasil dihapus');
    }

    }
    public function kelasedit($idpe=null){
      $idpe = base64_decode($idpe);
      $id   = Session::get('idsekolah');
      $check  = KelasModel::where('id_sekolahkelas',$id)
              ->where('id_kelas',$idpe)
              ->count();
      if($check > 0){
        $data = KelasModel::where('id_sekolahkelas',$id)
                ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_kelas.id_sekolahkelas')
                ->orderBy('kelas','ASC')
                ->get();
                $e = KelasModel::where('id_sekolahkelas',$id)->where('id_kelas',$idpe)
                        ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_kelas.id_sekolahkelas')
                        ->first();
        return view('operator.kelas.kelasedit',['data'=>$data],['e'=>$e]);
      }
      else{
        return redirect('/datamaster/datakelas')->with('danger','Data tidak tersedia');
      }

    }



    public function updatekelas(Request $request){
       $id     = Session::get('idsekolah');
       $checknamakelas = KelasModel::where('id_sekolahkelas',$id)
                         ->where('kelas',$request->kls)->count();
        if($checknamakelas > 0){
          return back()->with('danger','Tidak ada data yang diupdate !!!, Nama Kelas sudah ada');
        }else{
          $data = [
                'kelas' => $request->kls,
                'id_sekolahkelas' => $id
          ];
          $action = KelasModel::where('id_kelas',$request->id)->update($data);
          return redirect('/datamaster/datakelas')->with('success','Data berhasil diupdate');
        }


    }



}
