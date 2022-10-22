<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interfaces\HafalanInterfaces;
use App\WkModel;
use Session;

class HafalanController extends Controller
{
   private $interfaces;

   public function __construct(HafalanInterfaces $interfaces)
   {
      $this->hafalan= $interfaces;
   }
    public function index(Request $r)
    {
        $siswa = $this->hafalan->getAll();
        $data = $this->hafalan->getAllStudent();
        $wk    = WkModel::where('id_akses',Session::get('id_user'))->first();
        return view('operator.hafalan.index',compact('siswa','wk','data'));
    }
    public function add(Request $r){
        $array =[
            'id_siswa'=>$r->nama,
            'id_kelas'=>$r->id_kelas,
            'batas_hafalan'=>$r->batas,
            'tgl_setor'=>$r->tgl,
            'id_sekolah'=>Session::get('idsekolah'),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
        try {
            $this->hafalan->create($array);
            return back()->with('success','Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('dangger',$th->getmessage());
        }
    }
    public function update(Request $r){
        $array =[
            'id_siswa'=>$r->nama,
            'id_kelas'=>$r->id_kelas,
            'batas_hafalan'=>$r->batas,
            'tgl_setor'=>$r->tgl,
            'id_sekolah'=>Session::get('idsekolah'),
        ];
        try {
            $this->hafalan->update($r->id,$array);
            return back()->with('success','Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('dangger',$th->getmessage());
        }
    }
    public function delete($id){
        try {
            $this->hafalan->delete($id);
            return back()->with('success','Data berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('danger',$th->getmessage());
        }
    }

    public function ApistudentHafalan($kelas,$idsekolah,array $nis){
        try {
            $data = $this->hafalan->getApistudent($kelas,$idsekolah,$nis);
             $d = [
            'data'=>$data
            ];
            print json_encode($d);
        } catch (\Throwable $th) {
            return back()->with('danger',$th->getmessage());
        }
    }

}
