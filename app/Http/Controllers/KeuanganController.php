<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PosModel;
use App\PaymentModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class KeuanganController extends Controller
{
  public function poskeuangan(){
    $id   = Session::get('idsekolah');
    $data = PosModel::where('id_sekolahpos',$id)->get();
    return view('operator.keuangan.poskeuangan',['data'=>$data]);
  }

  public function tambahpos(Request $request){
    $id   = Session::get('idsekolah');
    $data = [
      'pos'=> $request->pos,
      'keterangan'=> $request->keterangan,
      'id_sekolahpos'=> $id
    ];
    $action = PosModel::insert($data);
    return redirect('/keuangan/poskeuangan')->with('success','Data berhasil disimpan');
  }

  public function deletepos($id=null){

    $check  = PaymentModel::where('id_pos',$id)->count();
    if($check > 0){
    return redirect('/keuangan/poskeuangan')->with('danger','Data Terseut telah berelasi dengan jenis pembayaran ');
    }
    else{
      $action = PosModel::where('id_pos',$id)->delete();
      return redirect('/keuangan/poskeuangan')->with('success','Data berhasil dihapus');
    }

  }
  public function poskeuanganedit($idp=null){
    $idp = base64_decode($idp);
    $check  = PosModel::where('id_pos',$idp)->count();
    if($check == 0){
    return redirect('/keuangan/poskeuangan')->with('danger','Data kosong !!! ');
    }
    else{
      $id   = Session::get('idsekolah');
      $data = PosModel::where('id_sekolahpos',$id)->get();
      $e    = PosModel::where('id_pos',$idp)->where('id_sekolahpos',$id)->first();
      return view('operator.keuangan.poskeuanganedit',['data'=>$data],['e'=>$e]);
    }

  }
  public function updatepos(Request $request){

    $data = [
      'pos'=> $request->pos,
      'keterangan'=> $request->keterangan
    ];
    $action = PosModel::where('id_pos',$request->id)->update($data);
    return redirect('/keuangan/poskeuangan')->with('success','Data berhasil diupdate');
  }

}
