<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PosModel;
use App\KebijakanModel;
use App\PaymentModel;
use App\TahunModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class KebijakanController extends Controller
{
  public function kebijakan(){
    $id   = Session::get('idsekolah');
    $data = KebijakanModel::where('id_sekolah',$id)
            ->where('tbl_tahunajaran.status','Y')
            ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','tbl_kebijakan.id_tahun')
            ->get();
    $th   = TahunModel::where('status','Y')->get();
    return view('operator.kebijakan.kebijakan',['data'=>$data],['th'=>$th]);
  }

  public function kebijakanedit($idkeb=null){
    $idkeb  = base64_decode($idkeb);
    $id   = Session::get('idsekolah');
    $data = KebijakanModel::where('id_sekolah',$id)
            ->where('tbl_tahunajaran.status','Y')
            ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','tbl_kebijakan.id_tahun')
            ->get();
    $e    = KebijakanModel::where('tbl_kebijakan.id_kebijakan',$idkeb)
            ->where('id_sekolah',$id)
            ->where('tbl_tahunajaran.status','Y')
            ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','tbl_kebijakan.id_tahun')
            ->first();
    $th   = TahunModel::where('status','Y')->get();
    return view('operator.kebijakan.kebijakanedit',['data'=>$data],['th'=>$th])->with(['e'=>$e]);
  }

  public function kebijakantambah(Request $request){
    $id   = Session::get('idsekolah');
    $data = [
      'kebijakan'=>$request->keb,
      'id_tahun'=>$request->idtahun,
      'id_sekolah'=>$id,

    ];
    $checkkebijakan = KebijakanModel::where('kebijakan',$request->keb)
                      ->where('id_tahun',$request->idtahun)->count();
    if($checkkebijakan > 0){
      return back()->with('danger','Data sudah tersedia');
    }
    else{
      $action = KebijakanModel::insert($data);
      return back()->with('success','Data berhasil disimpan');
    }

  }
  public function updatekeb(Request $request){
    $id   = Session::get('idsekolah');
    $data = [
      'kebijakan'=>$request->keb,
      'id_tahun'=>$request->idtahun,
      'id_sekolah'=>$id,

    ];

      $action = KebijakanModel::where('id_kebijakan',$request->id)->update($data);
      return back()->with('success','Data berhasil diupdate');


  }

    public function delkeb($id=null){
      $action = KebijakanModel::where('id_kebijakan',$id)->delete();
      return back()->with('success','Data berhasil dihapus');
    }


}
