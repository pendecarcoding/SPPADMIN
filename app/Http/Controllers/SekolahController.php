<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\InstansiModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class SekolahController extends Controller
{
  public function pengaturansekolah(){
    return view('operator.pengaturan.pengaturansekolah');
  }
  public function updatedatasekolah(Request $request){

    $data = [
      'nm_sekolah' => $request->nmsekolah,
      'al_sekolah' => $request->alsekolah,
      'kecamatan' => $request->kec,
      'kabupaten' => $request->kab,
      'nm_kepsek' => $request->kepsek,
      'nipkepsek' => $request->nipkepsek,
      'bendahara' => $request->bend,
      'nipbendahara' => $request->nipbend,
      'website' => $request->website,
      'email' => $request->email,
      'nohp' => $request->nohp
    ];
    $action = InstansiModel::where('id_sekolah',$request->id)->update($data);
    return redirect ('/operator/pengaturan/sekolah')->with('success','Data berhasil diupdate');

  }
  public function uploadlogo(Request $request){

    $photo = base64_encode(file_get_contents($request->file('logo')));
    $photo = str_replace('data:image/png;base64,', '', $photo);
    $photo = str_replace(' ', '+', $photo);
    $img   = base64_decode($photo);
    $file  = uniqid() . '.png';
    if($request->nmlogo != 'admin.png' AND $request->nmlogo != null){
    if(file_exists(public_path('images/logo/'.$request->nmlogo)))
    {
    unlink(public_path('images/logo/'.$request->nmlogo));
    }
  }
    $data = [
      'logo'=>$file
    ];
    $action = InstansiModel::where('id_sekolah',$request->id)->update($data);
    if($action){
      file_put_contents(public_path().'/images/logo/'.$file, $img);
      return redirect ('/operator/pengaturan/sekolah')->with('success','Data berhasil diupdate');

    }


  }
  public function chart(){
    return view('admin.chart');
  }
  public function chartpe(){
    return view('admin.chartpengeluaran');
  }

}
