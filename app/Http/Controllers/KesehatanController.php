<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interfaces\KesehatanInterfaces;
use App\WkModel;
use App\SiswaModel;
use Session;

class KesehatanController extends Controller
{
    private $kesehatan;

   public function __construct(KesehatanInterfaces $kesehatan)
   {
      $this->kesehatan = $kesehatan;
   }
    public function index(Request $r)
    {
        $wk    = WkModel::where('id_akses',Session::get('id_user'))->first();
        $siswa = SiswaModel::where('id_sekolahsiswa',Session::get('idsekolah'))
            ->where('statussiswa','Aktif')
            ->where('tbl_siswa.id_kelas',$wk->id_kelas)
            ->join('tbl_kelas','tbl_kelas.id_kelas','tbl_siswa.id_kelas')
            ->join('tbl_sekolah','tbl_sekolah.id_sekolah','tbl_siswa.id_sekolahsiswa')
            ->orderBy('kelas','ASC')
            ->orderBy('nama','ASC')
            ->get();
        $data = $this->kesehatan->getAllStudent();

        return view('operator.kesehatan.index',compact('siswa','wk','data'));
    }

    public function add(Request $r){
        $array=[
            'id_siswa'=>$r->nama,
            'id_kelas'=>$r->id_kelas,
            'kesehatan'=>$r->keterangan,
            'tgl_checkup'=>now(),
            'id_sekolah'=>Session::get('idsekolah'),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];

        try {
            $this->kesehatan->create($array);
            return back()->with('success','Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('danger',$th->getmessage());
        }

    }

    public function update(Request $r){
        $array=[
            'id_siswa'=>$r->nama,
            'id_kelas'=>$r->id_kelas,
            'kesehatan'=>$r->keterangan,
            'id_sekolah'=>Session::get('idsekolah'),
        ];

        try {
            $this->kesehatan->update($r->id,$array);
            return back()->with('success','Data berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('danger',$th->getmessage());
        }
    }

    public function delete($id){
        try {
            $this->kesehatan->delete($id);
            return back()->with('success','Data berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('danger',$th->getmessage());
        }
    }

    //API

    public function ApistudentKesehatan($kelas,$idsekolah,array $nis){
        try {
            $data = $this->kesehatan->getApistudent($kelas,$idsekolah,$nis);
             $d = [
            'data'=>$data
            ];
            print json_encode($d);
        } catch (\Throwable $th) {
            return back()->with('danger',$th->getmessage());
        }
    }


}
