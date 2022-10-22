<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuruRequest;
use App\Interfaces\GuruInterfaces;
use App\Repositories\GuruRepository;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class GuruController extends Controller
{
   private $GuruRepository;

   public function __construct(GuruRepository $GuruRepository)
   {
      $this->guru = $GuruRepository;
   }
   public function index(Request $r){
      if($r->is('datamaster/editguru*')){
        $data = $this->guru->getAll();
        $view = $this->guru->getById(base64_decode($r->id));
        return view('operator.kelas.guru',compact('data','view'));
      }
      else{
        $data = $this->guru->getAll();
        return view('operator.kelas.guru',compact('data'));
      }

   }
   public function delete($id){
     $ac = $this->guru->delete(base64_decode($id));
     if($ac){
       return back()->with('success','Data berhasil dihapus');
     }else{
       return back();
     }
   }
   public function update(Request $r){
     $ac = $this->guru->update(base64_decode($r->id),[
       'nip'=>$r->nip,
       'nama_guru'=>$r->nama,
       'alamat'=>$r->alamat,
       'nohp'=>$r->nohp,
       'email'=>$r->email,
     ]);
     if($ac){
       return back()->with('success','Data berhasil diupdate');
     }else{
       return back()->with('success','Data tidak ada yang berubah');
     }
   }
   public function create(GuruRequest $r){
     $arr=[
       'nip'=>$r->nip,
       'nama_guru'=>$r->nama,
       'alamat'=>$r->alamat,
       'nohp'=>$r->nohp,
       'email'=>$r->email,
       'id_sekolah'=>Session::get('idsekolah'),
     ];
     $act = $this->guru->create($arr);
     if($act){
       return back()->with('success','Data berhasil disimpan');
     }
   }


}
