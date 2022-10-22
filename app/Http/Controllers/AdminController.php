<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanModel;
use App\PemasukanModel;
use App\PengeluaranModel;
use App\BayarBebasModel;
use App\BayarBulananModel;
use App\PegawaiModel;
use App\BidangModel;
use App\DPAModel;
use App\InstansiModel;
use App\NotaModel;
use App\SiswaModel;
use App\SPTModel;
use App\SPPDModel;
use PDF;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class AdminController extends Controller
{
  //login
  public function login(){
      if(session()->has('login','username')) {
          return redirect('admin/');
        }
        else{
          return view('admin.login');
        }

}
public function logout(){
    Session::flush();
    return redirect('/admin');
  }
public function loginPost(Request $request){
      if($request==''){
        return redirect('/login/admin/')->with('alert','Username atau password, Salah!!');
      }

      else{
        $username = $request->username;
        $password = md5($request->password);

        $check    = PengaturanModel::where('username',$username)
                    ->Where('password',$password)
                    ->count();

        $data     = PengaturanModel::where('username',$username)
                    ->Where('password',$password)
                    ->first();

        if($check > 0 AND $data->level=='admin'){ //apakah email tersebut ada atau tidak

                Session::put('level',$data->level);
                Session::put('id_user',$data->id_admin);
                Session::put('idsekolah',$data->idsekolah);
                Session::put('login',TRUE);
                return redirect('/admin');
        }
        else if ($check > 0 AND $data->level=='operator'){
                  Session::put('level',$data->level);
                  Session::put('id_user',$data->id_admin);
                  Session::put('idsekolah',$data->idsekolah);
                  Session::put('login',TRUE);
                  return redirect('/admin');
        }
        else if ($check > 0 AND $data->level=='walikelas'){
                  Session::put('level',$data->level);
                  Session::put('id_user',$data->id_admin);
                  Session::put('idsekolah',$data->idsekolah);
                  Session::put('login',TRUE);
                  return redirect('/kesehatansiswa');
        }
        else{

          return redirect('/login/admin/')->with('alert','Username atau password, Salah!!');

        }
      }

  }
  public function admin(){
    $date                 = date('Y-m-d');
    $id                   = Session::get('idsekolah');
    $totbayarbulanan      = BayarBulananModel::Where('idsekolahbb',$id)->where('tanggal',$date)->sum('jumlah_bayar');
    $totbayarbebas        = BayarBebasModel::Where('idsekolahbe',$id)->where('tanggal',$date)->sum('jumlah_bayar');
    $cnsis     = SiswaModel::where('id_sekolahsiswa',$id)->where('statussiswa','!=','Alumni')->count();
    $ppto      = PemasukanModel::where('tanggal',$date)->Where('id_sekolahpe',$id)->sum('nominal');
    $cnpeto    = $totbayarbulanan+$totbayarbebas+$ppto;
    $cnketo    = PengeluaranModel::where('tanggal',$date)->Where('idsekolahkeluar',$id)->sum('nominal');
    $bebas     = BayarBebasModel::where('idsekolahbe',$id)->sum('jumlah_bayar');
    $bulan     = BayarBulananModel::Where('idsekolahbb',$id)->sum('jumlah_bayar');
    $pendapatan = PemasukanModel::where('id_sekolahpe',$id)->sum('nominal');
    $pengeluaran = PengeluaranModel::where('idsekolahkeluar',$id)->sum('nominal');
    $saldo       = $bebas+$bulan+$pendapatan-$pengeluaran;

    return view('admin.dashboard',['cnsis'=>$cnsis],['cnpeto'=>$cnpeto])->with(['cnketo'=>$cnketo])->with(['saldo'=>$saldo]);
  }

  //Pengaturan
  public function pengaturan(){
    $iduser  = Session::get('id_user');
    $pegawai = PegawaiModel::where('bidang','KEPALA DINAS')
    ->join('tbl_bidang','tbl_bidang.id_bidang','=','tbl_pegawai.id_bidang')->get();
    $data    = PengaturanModel::where('level','admin')
    ->where('id_user',$iduser)
    ->join('tbl_instansi','tbl_instansi.id_instansi','users.id_instansi')
    ->first();
    return view('admin.datapengaturan',['data'=>$data],['pg'=>$pegawai]);
  }
  //pengaturanop
  public function pengaturanop(){
    $iduser = Session::get('id_user');
    $data = PengaturanModel::where('level','operator')
    ->where('id_admin',$iduser)
    ->join('tbl_sekolah','tbl_sekolah.id_sekolah','admin.idsekolah')
    ->first();
    return view('operator.pengaturan.datapengaturan',['data'=>$data]);
  }



  public function updateadmin(Request $request){
    if($request->foto==''){
          $data = [
                  'namauser' => $request->nama,
                  'nohp' => $request->nohp,
                  'colour' => $request->warna
                ];
              $store = PengaturanModel::where('id_user',$request->id)->update($data);
              return redirect('admin/pengaturan/')->with('success','Data berhasil di update');
      }
      else{



        $nmfile = $request->file;
        if($nmfile <>'' AND $nmfile <>'admin.png'){
          $file_path = public_path().'/images/'.$nmfile;
          unlink($file_path);
        }
        $file = $request->file('foto');
        $name = time().$file->getClientOriginalName();
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('images/' .$name));



        $data = [
                'namauser' => $request->nama,
                'nohp' => $request->nohp,
                'foto' => $name,
                'colour' => $request->warna
              ];

            $store = PengaturanModel::where('id_user',$request->id)->update($data);
            return redirect('admin/pengaturan/')->with('success','Data berhasil di update');

      }

  }


  public function updateopr(Request $request){
    if($request->foto==''){
          $data = [
                  'nama' => $request->nama,
                  'nohpuser' => $request->nohp,
                  'colour' => $request->warna
                ];
              $store = PengaturanModel::where('id_admin',$request->id)->update($data);
              return redirect('operator/pengaturan/')->with('success','Data berhasil di update');
      }
      else{

        $nmfile = $request->file;
        $photo = base64_encode(file_get_contents($request->file('foto')));
        $photo = str_replace('data:image/png;base64,', '', $photo);
        $photo = str_replace(' ', '+', $photo);
        $img   = base64_decode($photo);
        $file  = uniqid() . '.png';
        if($nmfile != 'admin.png' AND $nmfile != null){
        if(file_exists(public_path('images/'.$nmfile)))
        {
        unlink(public_path('images/'.$nmfile));
        }
        }
        $data = [
                'nama' => $request->nama,
                'nohpuser' => $request->nohp,
                'foto' => $file,
                'colour' => $request->warna
              ];
         $store = PengaturanModel::where('id_admin',$request->id)->update($data);
         if($store){
           file_put_contents(public_path().'/images/'.$file, $img);
           return redirect('operator/pengaturan/')->with('success','Data berhasil di update');
         }else{
           return back()->with('danger','Data gagal diupdate');
         }


      }

  }

  //Update instansi
  public function updateinstansi(Request $request){
    if($request->logo==''){
          $data = [
                  'kode_instansi' => $request->kodeinstansi,
                  'instansi' => $request->instansi,
                  'alamat' => $request->alamat,
                  'countspt' => $request->riwayatspt,
                  'email' => $request->email,
                  'id_pegawai' => $request->nip,
                  'pemerintahan' => $request->pemerintahan
                ];
              $store = InstansiModel::where('id_instansi',$request->id)->update($data);
              return redirect('admin/pengaturan/')->with('success','Data berhasil di update');
      }
      else{
        $nmfile = $request->file;
        $file_path = public_path().'/images/logo/'.$nmfile;
        unlink($file_path);
        $file = $request->file('logo');
        $name = time().$file->getClientOriginalName();
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('images/logo/' .$name));

        $data = [
                'kode_instansi' => $request->kodeinstansi,
                'instansi' => $request->instansi,
                'alamat' => $request->alamat,
                'countspt' => $request->riwayatspt,
                'email' => $request->email,
                'id_pegawai' => $request->nip,
                'pemerintahan' => $request->pemerintahan,
                'logo' => $name
              ];
            $store = InstansiModel::where('id_instansi',$request->id)->update($data);
            return redirect('admin/pengaturan/')->with('success','Data berhasil di update');

      }

  }

  public function updateprivasi(Request $request){
    $pass1 = $request->pass1;
    $pass2 = $request->pass2;
    $pasmd = md5($request->pass1);

    if($pass1 <> $pass2){
        return redirect('admin/pengaturan/')->with('danger','Password Tidak Sama !!!');
    }
    else{
      $data = [
              'username' => $request->username,
              'password' => $pasmd
            ];
            $store = PengaturanModel::where('id_user',$request->id)->update($data);
            return redirect('admin/pengaturan/')->with('success','Data berhasil di update');
    }

  }
  //UPDATE updateprivasiop
  public function updateprivasiope(Request $request){
    $pass1 = $request->pass1;
    $pass2 = $request->pass2;
    $pasmd = md5($request->pass1);

    if($pass1 <> $pass2){
        return redirect('operator/pengaturan')->with('danger','Password Tidak Sama !!!');
    }
    else{
      $check = PengaturanModel::where('username',$request->username)
                                ->where('password',$pasmd)->count();
      if($check > 0){
        return redirect('operator/pengaturan')->with('danger','Username Sudah di Gunakan !!!');
      }else{
        $data = [
                'username' => $request->username,
                'password' => $pasmd
              ];
              $store = PengaturanModel::where('id_admin',$request->id)->update($data);
              return redirect('operator/pengaturan')->with('success','Data berhasil di update');
      }

    }

  }

  //UPDATE Riwayat SURAT
  public function updateriwayatsurat(Request $request){

    $data = [
        'countsppd' => $request->countsppd,
        'countnota' => $request->countnota
    ];
    $update = BidangModel::where('id_bidang',$request->id_bidang)->update($data);
    return redirect('operator/pengaturan')->with('success','Data berhasil di update');

  }



  //Data datapegawai
  public function datapegawai(){
    $data = PegawaiModel::orderBy('nama', 'asc')->get();
    return view('admin.datapegawai',['data'=>$data]);
  }

  public function tambahdatapegawai(){
        $data = BidangModel::Where('bidang','!=','Belum Diatur')
        ->where('bidang','!=','All')->get();
        return view('admin.tambahpegawai',['data'=>$data]);
  }
  public function hapuspegawai($id=null){
            PegawaiModel::Where('id_pegawai',$id)->delete();
            return redirect('/master/datapegawai')->with('flash_message_success','Data Berhasil Dihapus');

          }
  public function tambahpegawai(Request $request){
    $file = $request->file('foto');
    $name = time().$file->getClientOriginalName();
    $image_resize = Image::make($file->getRealPath());
    $image_resize->resize(300, 300);
    $image_resize->save(public_path('images/dp/' .$name));

    $data = [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'golongan' => $request->golongan,
            'jenis_pangkat' => $request->jenispangkat,
            'jabatan' => $request->jabatan,
            'foto' => $name,
            'id_bidang' => $request->idbidang
          ];

        $store = PegawaiModel::insert($data);
        return redirect('/master/datapegawai')->with('success','Data berhasil di Simpan');
  }

  public function editpegawai($id){
        $datab = BidangModel::Where('bidang','!=','Belum Diatur')
        ->where('bidang','!=','All')->get();
        $data = PegawaiModel::where('id_pegawai',$id)->first();
        return view('admin.editpegawai',['d'=>$data],['db'=>$datab]);

  }

  public function updatepegawai(Request $request){

    if($request->foto==''){
      $data = [
              'nip' => $request->nip,
              'nama' => $request->nama,
              'golongan' => $request->golongan,
              'jenis_pangkat' => $request->jenispangkat,
              'jabatan' => $request->jabatan,
              'id_bidang' => $request->idbidang

            ];

          $store = PegawaiModel::where('id_pegawai',$request->id)->update($data);
          return redirect('/master/datapegawai')->with('success','Data berhasil di update');
    }
    else{
      $nmfile = $request->file;
      if($nmfile <>'' AND $nmfile <>'admin.png'){
        $file_path = public_path().'/images/dp/'.$nmfile;
        unlink($file_path);
      }
      $file = $request->file('foto');
      $name = time().$file->getClientOriginalName();
      $image_resize = Image::make($file->getRealPath());
      $image_resize->resize(300, 300);
      $image_resize->save(public_path('images/dp/' .$name));


      $data = [
              'nip' => $request->nip,
              'nama' => $request->nama,
              'golongan' => $request->golongan,
              'jenis_pangkat' => $request->jenispangkat,
              'jabatan' => $request->jabatan,
              'foto' => $name,
              'id_bidang' => $request->idbidang
            ];

          $store = PegawaiModel::where('id_pegawai',$request->id)->update($data);
          return redirect('/master/datapegawai')->with('success','Data berhasil di update');
    }

  }

  //Operator
  public function dataoperator(){
    $data = PengaturanModel::Where('level','operator')->get();
    return view('admin.dataop',['data'=>$data]);
  }
  public function tambahdataop(){
        return view('admin.tambahoperator');
  }
  public function tambahoperator(Request $request){
    $pass1 = $request->pass1;
    $pass2 = $request->pass2;
    $pass  = md5($request->pass2);

    if($pass1 <> $pass2){
          return redirect('/master/dataoperator/tambah')->with('danger','Password tidak sama');
    }
    else{
      $data = [
              'id_bidang' => '0',
              'id_instansi' => $request->idinstansi,
              'namauser' => $request->nama,
              'nohp' => $request->nohp,
              'username' => $request->uname,
              'Password' => $pass,
              'level' => 'operator',
              'foto' => 'admin.png',
              'colour'=>'#222d32'
            ];
          $store = PengaturanModel::insert($data);
          return redirect('/master/dataoperator')->with('success','Data berhasil di tambah');

    }

  }
  //hapus operator
  public function hapusop($id=null){
            PengaturanModel::Where('id_user',$id)->delete();
            return redirect('/master/dataoperator')->with('flash_message_success','Data Berhasil Dihapus');

  }
  //view edit Operator
  public function editop($id){
        $data = PengaturanModel::where('id_user',$id)->first();
        return view('admin.editoperator',['d'=>$data]);

  }

  //Update Data Operator
  public function updateoperator(Request $request){
    $data = [
            'namauser' => $request->nama,
            'nohp' => $request->nohp
          ];

        $store = PengaturanModel::where('id_user',$request->id)->update($data);
        return redirect('/master/dataoperator')->with('success','Data berhasil di update');
  }
  //updatehak
  public function updatehak(Request $request){
    $data = [
            'id_bidang' => $request->idbidang
          ];

        $store = PengaturanModel::where('id_user',$request->id)->update($data);
        return redirect('/master/dataoperator')->with('success','Hak akses berhasil ditetapkan');
  }

    //Update Privasi Operator

    public function updateprivasiop(Request $request){
      $pass1 = $request->pass1;
      $pass2 = $request->pass2;
      $pass  = md5($request->pass1);
      if($pass1<>$pass2){
        return redirect("/master/dataoperator/edit/$request->id")->with('danger','Password tidak sama');
      }
      else{
        $data = [
                'username' => $request->uname,
                'password' => $pass

              ];

            $store = PengaturanModel::where('id_user',$request->id)->update($data);
            return redirect("/master/dataoperator/edit/$request->id")->with('success','Data berhasil di update');
      }

    }


    //Data Bidang

    //[view bidang]
    public function databidang(){
      $data = BidangModel::Where('bidang','!=','All')
              ->Where('bidang','!=','Belum Diatur')->get();
      return view('admin.databidang',['data'=>$data]);
    }
    //[view tambah bidang]

    public function vtambahbidang(){
      return view('admin.tambahbidang');
    }

    //[Aksi tambah bidang]
    public function tambahbidang(Request $request){
      if($request->nosurat==''){
        $nosurat = 0;
      }
      if($request->nosurat<>''){
        $nosurat = $request->nosurat;
      }
      if($request->nosppd==''){
        $nosppd  = 0;
      }
      if($request->nosppd<>''){
        $nosppd  = $request->nosppd;
      }
      $data = [
              'bidang' => $request->namabidang,
              'countsppd' => $nosppd,
              'countnota' => $nosurat
          ];
          $store = BidangModel::insert($data);
          return redirect("master/databidang")->with('success','Data berhasil di tambah');

    }
    //[Aksi Hapus bidang]---
    public function hapusbidang($id=null){
        BidangModel::Where('id_bidang',$id)->delete();
        return redirect('/master/databidang');
    }
    //[VIEW bidang]---
    public function editbidang($id){
          $data = BidangModel::where('id_bidang',$id)->first();
          return view('admin.editbidang',['d'=>$data]);

    }

    //[Update Bidang]---
    public function updatebidang(Request $request){
      $data = [
              'bidang' => $request->namabidang,
              'countsppd' => $request->nosppd,
              'countnota' => $request->nosurat
            ];

          $store = BidangModel::where('id_bidang',$request->id)->update($data);
          return redirect('/master/databidang')->with('success','Data berhasil diupdate');
    }

    //[data DPA]
    public function datadpa(){
      $data = DPAModel::join('tbl_bidang','tbl_bidang.id_bidang','=','tbl_dpa.id_bidang')->get();
      return view('admin.datadpa',['data'=>$data]);
    }

    //[view tambah DPA]

    public function vtambahdpa(){
      $databidang = BidangModel::Where('bidang','!=','All')
              ->Where('bidang','!=','Belum Diatur')
              ->Where('bidang','!=','KEPALA DINAS')->get();
      return view('admin.tambahdpa',['data'=>$databidang]);
    }

    //Tambah DPAModel
    public function tambahdpa(Request $request){
      $data = [
              'no_dpa' => $request->nodpa,
              'id_bidang' => $request->idbidang
            ];
      $store = DPAModel::insert($data);
      return redirect('master/datadpa')->with('success','Data berhasil ditambah');
      }

    //Hapus DPAModel
    public function hapusdpa($id=null){
        DPAModel::Where('id_dpa',$id)->delete();
        return redirect('/master/datadpa');
    }

    //[VIEW Edit DPA]---
    public function editdpa($id){
          $data = BidangModel::Where('bidang','!=','All')
                  ->Where('bidang','!=','Belum Diatur')->get();
          $dataedit = DPAModel::where('id_dpa',$id)->first();
          return view('admin.editdpa',['data'=>$data],['d'=>$dataedit]);

    }

    //[Update dpa]---
    public function updatedpa(Request $request){
      $data = [
              'id_bidang' => $request->idbidang,
              'no_dpa' => $request->nodpa
            ];

          $store = DPAModel::where('id_dpa',$request->id)->update($data);
          return redirect('/master/datadpa')->with('success','Data berhasil diupdate');
    }

    //Data Notadinas
    public function datanotdinas(){

      $idbidang = Session::get('idbidang');
      $data = NotaModel::where('id_bidang',$idbidang)->get();
      return view('admin.datanotadinas',['data'=>$data]);
    }

    //Tambah Notadinas
    public function tambahnota(){
      $tahun        = date('Y');
      $id_instansi  = Session::get('idinstansi');
      $id_bidang    = Session::get('idbidang');
      $bidang       = BidangModel::where('id_bidang',$id_bidang)->first();
      $nosurat      = $bidang->countnota+1;
      $instansi     = InstansiModel::where('id_instansi',$id_instansi)->first();

      if($id_bidang == 4){

        $pg = PegawaiModel::all();
      }
      else{
        $pg = PegawaiModel::where('id_bidang',$id_bidang)->get();
      }

      return view('admin.tambahnota',['pg'=>$pg],['idinstansi'=>$instansi])
      ->with(['bidang'=>$bidang])
      ->with(['tahun'=>$tahun])
      ->with(['nosurat'=>$nosurat]);
    }
    //Simpan Notadinas
    public function simpannota(Request $request){
      $datanip = $request->nip;
      $implode = implode(",",$datanip);

      $data = [
              'nip' => $implode,
              'id_bidang' => $request->idbidang,
              'kepada' => $request->kepada,
              'dari' => $request->dari,
              'tanggal' => $request->tgl,
              'nomor' => $request->nosurat,
              'hal' => $request->hal,
              'isi' => $request->isi,
              'jbtn_ttd' => $request->jbtnttd,
              'tujuan' => $request->tujuan,
              'ttd_id_pegawai' => $request->ttd_id_pegawai
            ];
          $valsurat =[
              'countnota' =>$request->valsurat
          ];


          $store      = NotaModel::insert($data);
          $upvalsurat = BidangModel::where('id_bidang',$request->idbidang)->update($valsurat);
          return redirect('/surat/datanotadinas/')->with('success','Data berhasil disimpan');

    }

    //Hapus Notadinas
    public function hapusnota($id=null){
        NotaModel::Where('id_notadinas',$id)->delete();
        return redirect('/surat/datanotadinas');
    }
    //DOWNLOAD Notadinas
    public function downloadnotadinas($id=null){
      $id_user    = Session::get('id_user');
      $instansi   = PengaturanModel::Where('id_user',$id_user)
                    ->join('tbl_instansi','tbl_instansi.id_instansi','=','users.id_instansi')
                    ->first();
      $karyawan  = NotaModel::Where('id_notadinas',$id)->first();
      $notadinas = NotaModel::Where('id_notadinas',$id)->
                    join('tbl_pegawai','tbl_pegawai.id_pegawai','=','tbl_notadinas.ttd_id_pegawai')->first();
      $pdf       = PDF::loadView('pdf.notadinas',['instansi'=>$instansi],['nota'=>$notadinas]);
      return $pdf->download("notadinas_{$notadinas->nomor}_{$id}.pdf");
    }

    //Print NOTA VIEW
    public function printnotaview($id=null){
        $id_user    = Session::get('id_user');
        $instansi   = PengaturanModel::Where('id_user',$id_user)
                      ->join('tbl_instansi','tbl_instansi.id_instansi','=','users.id_instansi')
                      ->first();
        $notadinas = NotaModel::Where('id_notadinas',$id)->
                      join('tbl_pegawai','tbl_pegawai.id_pegawai','=','tbl_notadinas.ttd_id_pegawai')->first();
        return view('pdf.notadinas',['instansi'=>$instansi],['nota'=>$notadinas]);
    }

    //Print Surat Perintah Tugas
    public function printsptview($id=null){
        $id_user    = Session::get('id_user');
        $instansi   = PengaturanModel::Where('id_user',$id_user)
                      ->join('tbl_instansi','tbl_instansi.id_instansi','=','users.id_instansi')
                      ->first();
        $spt        = SPTModel::Where('id_spt',$id)->
                      join('tbl_notadinas','tbl_notadinas.id_notadinas','=','tbl_spt.id_notadinas')->first();
        return view('pdf.spt',['instansi'=>$instansi],['spt'=>$spt]);
    }

    //Edit NOTA
    //Edit Notadinas
    public function editnota($id){
      $editnota   = NotaModel::where('id_notadinas',$id)->first();
      $nip        = explode(",",$editnota->nip);
      $id_bidang  = Session::get('idbidang');
      if($id_bidang == 4){
        //$pg  = PegawaiModel::whereNotIn('id_pegawai',$nip)->get();
        $pg = PegawaiModel::all();
      }
      else{
        //$pg  = PegawaiModel::where('id_pegawai',$id_bidang)
                          //->whereNotIn('id_pegawai',$nip)->get();
        $pg = PegawaiModel::where('id_bidang',$id_bidang)->get();
      }


      return view('admin.editnota',['pg'=>$pg],['editnota'=>$editnota]);
    }

    public function updatenota(Request $request){
      $datanip = $request->nip;
      $implode = implode(",",$datanip);

      $data = [
              'nip' => $implode,
              'id_bidang' => $request->idbidang,
              'kepada' => $request->kepada,
              'dari' => $request->dari,
              'tanggal' => $request->tgl,
              'nomor' => $request->nosurat,
              'hal' => $request->hal,
              'isi' => $request->isi,
              'jbtn_ttd' => $request->jbtnttd,
              'tujuan' => $request->tujuan,
              'ttd_id_pegawai' => $request->ttd_id_pegawai
            ];

          $store = NotaModel::where('id_notadinas',$request->idnotadinas)->update($data);
          return redirect('/surat/datanotadinas/')->with('success','Data berhasil diupdate');

    }

    //DATA SURAT PERINTAH Tugas
    public function dataspt(){
      $tahun        = date('Y');
      $id_instansi  = Session::get('idinstansi');
      $id_bidang    = Session::get('idbidang');
      $bidang       = BidangModel::where('id_bidang',$id_bidang)->first();
      $nosurat      = $bidang->countnota+1;
      $instansi     = InstansiModel::where('id_instansi',$id_instansi)
                      ->join('tbl_pegawai','tbl_pegawai.id_pegawai','=','tbl_instansi.id_pegawai')
                      ->join('tbl_bidang','tbl_bidang.id_bidang','=','tbl_pegawai.id_bidang')->first();
      $countspt     = $instansi->countspt+1;
      $data         = NotaModel::where('id_bidang',$id_bidang)->get();
      return view('admin.dataspt',['data'=>$data],['tahun'=>$tahun])
      ->with(['instansi'=>$instansi])
      ->with(['count'=>$countspt]);

    }
    //TAMBAH SPT
    public function tambahspt(){
      $id_bidang = Session::get('idbidang');
      if($id_bidang == 4){
        $pg = PegawaiModel::all();
      }
      else{
        $pg = PegawaiModel::where('id_bidang',$id_bidang)->get();
      }
      return view('admin.tambahspt',['pg'=>$pg]);
    }

    public function terbitkansptnota(Request $request){
      $id_instansi  = Session::get('idinstansi');
      $instansi     = InstansiModel::where('id_instansi',$id_instansi)->first();
      $countspt     = $instansi->countspt+1;
      $tgl          = date('Y-m-d');
      $data = [
              'id_notadinas' => $request->id_notadinas,
              'nospt' => $request->nospt,
              'dalamrangka' => $request->rangka,
              'lamaperjalanan' => $request->lamaperjalanan,
              'awal_tgl' => $request->awaltgl,
              'akhir_tgl' => $request->akhirtgl,
              'akhir_tgl' => $request->akhirtgl,
              'tgl_penetapan' => $tgl,
              'jabatan_ttd' => $request->jabatanttd,
              'id_pegawai' => $request->nipttd

            ];

      $spt = [
          'countspt' => $countspt
      ];
            $updatespt = InstansiModel::where('id_instansi',$id_instansi)->update($spt);
            $save      = SPTModel::insert($data);
            return redirect('/surat/dataspt')->with('success','Surat Berhasilkan diterbitkan');
    }

    //Terbitkan SPPD
    public function terbitkansppd(Request $request){
      $tgl  = date('Y-m-d');
      $data = [
              'id_spt' => $request->id_spt,
              'transportasi' => $request->angkutan,
              'pembayaran' => $request->sumber,
              'sppd_tgl_penetapan' => $tgl,
              'pengikut' => $request->pengikut,
              'ket_lainlain' => $request->ketlainlain

            ];
              $save      = SPPDModel::insert($data);
              return redirect('/surat/datasppd')->with('success','Surat Berhasilkan diterbitkan');

    }


    public function updatesptnota(Request $request){
      $idspt = $request->idspt;
      $data = [
              'id_notadinas' => $request->id_notadinas,
              'nospt' => $request->nospt,
              'dalamrangka' => $request->rangka,
              'lamaperjalanan' => $request->lamaperjalanan,
              'awal_tgl' => $request->awaltgl,
              'akhir_tgl' => $request->akhirtgl,
              'jabatan_ttd' => $request->jabatanttd,
              'id_pegawai' => $request->nipttd

            ];
            $update      = SPTModel::where('id_spt',$idspt)->update($data);
            return redirect('/surat/dataspt')->with('success','Surat Berhasilkan diupdate');
    }

    //Data SPPD
    public function datasppd(){
      $tahun        = date('Y');
      $id_instansi  = Session::get('idinstansi');
      $id_bidang    = Session::get('idbidang');
      $bidang       = BidangModel::where('id_bidang',$id_bidang)->first();
      $nosurat      = $bidang->countnota+1;
      $instansi     = InstansiModel::where('id_instansi',$id_instansi)
                      ->join('tbl_pegawai','tbl_pegawai.id_pegawai','=','tbl_instansi.id_pegawai')
                      ->join('tbl_bidang','tbl_bidang.id_bidang','=','tbl_pegawai.id_bidang')->first();
      $countspt     = $instansi->countspt+1;
      $data         = NotaModel::where('id_bidang',$id_bidang)
                      ->join('tbl_spt','tbl_spt.id_notadinas','=','tbl_notadinas.id_notadinas')->get();
      return view('admin.datasppd',['data'=>$data],['tahun'=>$tahun])
      ->with(['instansi'=>$instansi])
      ->with(['count'=>$countspt]);

    }
    //Print SPPD
    public function printsppd($id=null){
        $id_user    = Session::get('id_user');
        $instansi   = PengaturanModel::Where('id_user',$id_user)
                      ->join('tbl_instansi','tbl_instansi.id_instansi','=','users.id_instansi')
                      ->first();
        $spt        = SPTModel::Where('id_spt',$id)->
                      join('tbl_notadinas','tbl_notadinas.id_notadinas','=','tbl_spt.id_notadinas')->first();
        return view('pdf.sppd',['instansi'=>$instansi],['spt'=>$spt]);
    }


}
