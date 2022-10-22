<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalimuridRequest;
use App\WmModel;
use PDF;
use Session;
use App\Interfaces\WalimuridInterfaces;
use App\Interfaces\KesehatanInterfaces;
use App\Interfaces\HafalanInterfaces;
use Intervention\Image\ImageManagerStatic as Image;
class ApiController extends Controller
{

   private $Walimurid;
   private $kesehatan;
   private $hafalan;

   public function __construct(HafalanInterfaces $hafalan,
                WalimuridInterfaces $Walimurid,
                KesehatanInterfaces $kesehatan)
   {
      $this->wali = $Walimurid;
      $this->kesehatan = $kesehatan;
      $this->hafalan->$hafalan;
   }

    public function login(Request $r){
      return $this->wali->login($r);
    }
    public function update(Request $r){
        $data = [
        'nama'=>$r->nama,
        'nohp'=>$r->nohp,
        'alamat'=>$r->alamat,
        'email'=>$r->email,
        'id_sekolah'=>$r->id_sekolah,
     ];
     try {
      $act = $this->wali->update($r->id,$data);
        if($act){
            $json = [
                'message'=>'data berhasil diupdate',
            ];
            return response()->json($json);
        }else{
           $json = [
                'message'=>'data tidak ada diupdate',
            ];
            return response()->json($json);
        }

    } catch (\Throwable $th) {
         $json = [
                'message'=>$th->getmessage(),
            ];
        return response()->json($json);
    }
    }
    public function getinfospp(Request $r){

    }
    public function getinfohealth(Request $r){
       try {
        $data = $this->kesehatan->getApistudent($r->idkelas,$r->idsekolah,$r->nis);
        $json = [
                'message'=>'success',
                'data'=>$data
        ];
        return response()->json($json);
       } catch (\Throwable $th) {
        return response()->json([
            'message'=>$th->getmessage()
        ]);
       }
    }

    public function getinfohafalan(){
        try {
        $data = $this->hafalan->getApistudent($r->idkelas,$r->idsekolah,$r->nis);
        $json = [
                'message'=>'success',
                'data'=>$data
        ];
        return response()->json($json);
       } catch (\Throwable $th) {
        return response()->json([
            'message'=>$th->getmessage()
        ]);
       }
    }
}
