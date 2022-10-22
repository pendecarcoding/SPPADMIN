<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WmModel;
use PDF;
use Session;
use App\Interfaces\WalimuridInterfaces;
use Intervention\Image\ImageManagerStatic as Image;
class WalimuridController extends Controller
{

   private $Walimurid;

   public function __construct(WalimuridInterfaces $Walimurid)
   {
      $this->d = $Walimurid;
   }

  public function login(Request $r){
      return $this->d->login($r);
    }

  public function index(){
     $d = (object) $this->d->getAll();
     $data = $d->data;
     $siswa = $d->siswa;
     return view('operator.walimurid.walimurid',compact('data','siswa'));
  }
  public function create(Request $r){

     $data = [
        'nama'=>$r->nama,
        'nohp'=>$r->nohp,
        'alamat'=>$r->alamat,
        'email'=>$r->email,
        'id_sekolah'=>Session::get('idsekolah'),
        'password'=>md5($r->password),
        'id_siswa'=>implode(',',$r->id_siswa),
     ];
     try {
        $this->d->create($data);
        return back()->with('success','Data berhasil disimpan');
     } catch (\Throwable $th) {
        return back()->with('danger',$th->getmessage());
     }
  }
  public function delete($id){

    try {
        $this->d->delete($id);
        return back()->with('success','Data berhasil dihapus');
    } catch (\Throwable $th) {
        return back()->with('danger',$th->getmessage());
    }

  }

  public function update(Request $r){
    if($r->has('password')){
        $data = [
        'nama'=>$r->nama,
        'nohp'=>$r->nohp,
        'alamat'=>$r->alamat,
        'email'=>$r->email,
        'id_sekolah'=>Session::get('idsekolah'),
        'password'=>md5($r->password),
        'id_siswa'=>implode(',',$r->id_siswa),
     ];
    }else{
        $data = [
        'nama'=>$r->nama,
        'nohp'=>$r->nohp,
        'alamat'=>$r->alamat,
        'email'=>$r->email,
        'id_sekolah'=>Session::get('idsekolah'),
        'id_siswa'=>implode(',',$r->id_siswa),
     ];
    }
    try {
      $this->d->update($r->id,$data);
      return back()->with('success','Data berhasil diupdate');
    } catch (\Throwable $th) {
    return back()->with('danger',$th->getmessage());
    }
  }




}
