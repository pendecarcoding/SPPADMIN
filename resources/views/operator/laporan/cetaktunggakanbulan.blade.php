<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LAP Tunggakan Bulanan</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <style>
  /*Table */
  #customers {
font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}


  /*/Table*/
/* The container */
.container {
display: block;
position: relative;
padding-left: 35px;
margin-bottom: 12px;
cursor: pointer;
font-size: 22px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
position: absolute;
opacity: 0;
cursor: pointer;
height: 0;
width: 0;
}

/* Create a custom checkbox */
.checkmark {
position: absolute;
top: 0;
left: 0;
height: 25px;
width: 25px;
background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
content: "";
position: absolute;
display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
left: 9px;
top: 5px;
width: 5px;
height: 10px;
border: solid white;
border-width: 0 3px 3px 0;
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
}
</style>
</head>
<body>
  <?php
  $idsek = Session::get('idsekolah');
  $tgl=date('Y-m-d');
  function tgl_indo($tanggal){
                                    $bulan = array (
                                        1 =>   'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember'
                                    );
                                    $pecahkan = explode('-', $tanggal);

                                    // variabel pecahkan 0 = tanggal
                                    // variabel pecahkan 1 = bulan
                                    // variabel pecahkan 2 = tahun

                                    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                                    }
                                    $jenispayment = App\PembayaranModel::where('idsekolahpay',$idsek)->where('tipe','Bulanan')
                                                    ->where('id_tahun',$id_tahun)->get();
                                    $bulan        = App\BulanModel::all();
                                    $tahunajaran  = App\TahunModel::where('id_tahun',$id_tahun)->first();
                                    $kelas        = App\KelasModel::where('id_sekolahkelas',$idsek)->where('id_kelas',$id_kelas)->first();
                                    $siswa        = App\SiswaModel::where('riwayat_kelas.id_tahun',$id_tahun)->where('id_sekolahsiswa',$idsek)->where('riwayat_kelas.id_kelas',$id_kelas)
                                                    ->join('riwayat_kelas','riwayat_kelas.nis','tbl_siswa.nis')
                                                    ->get();
                                    
                                    $sekolah      = App\SekolahModel::where('id_sekolah',$idsek)->first();
                                    ?>

  <table>
<tr>
  <th><img style="width:100px;height:100px;" src="{{ public_path("images/logo/$sekolah->logo")}}"></th>
  <th colspan="3">
    <font size="5" face="verdana">{{$sekolah->nm_sekolah}}</font>
    <br><font size="3" type="verdana">{{$sekolah->al_sekolah}} Telp {{$sekolah->nohp}}</font><br>
    <font size="3" type="verdana">Website : {{$sekolah->website}} Email: {{$sekolah->email}}</font>
  </th>
</tr>


</table>
<hr>




<h3>Laporan Tunggakan Bulanan</h3>
<table>
<tr>
<th>Tahun Ajaran</th>
<th>:</th>
<th>{{$tahunajaran->tahun}}</th>
</tr>

<tr>

  <td>Kelas</td>
  <td>:</td>
  <td>{{$kelas->kelas}}<td>

</tr>
<tr>

  <td>Dicetak</td>
  <td>:</td>
  <td>{{tgl_indo($tgl)}}<td>

</tr>
</table>
  <table id="customers">
<tr>
<th rowspan="2">No</th>
<th rowspan="2">NIS</th>
<th rowspan="2">Nama</th>
<th colspan="12"><center>Bulan</center></th>


</tr>



<tr>
    <td>Jan</td>
    <td>Feb</td>
    <td>Mar</td>
    <td>Apr</td>
    <td>Mei</td>
    <td>Jun</td>
    <td>Jul</td>
    <td>Agu</td>
    <td>Sep</td>
    <td>Okt</td>
    <td>Nov</td>
    <td>Des</td>

</tr>

@foreach ($jenispayment as $key => $value)


<tr>
  <td colspan="15"><center>{{$value->namapayment}}</center></td>
</tr>
@foreach ($siswa as $index => $ds)
<tr>
  <td>{{$index+1}}</td>
  <td>{{$ds->nis}}</td>
  <td>{{$ds->nama}}</td>

  <?php
  $januaricek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Januari')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($januaricek <> 0) echo 'green'; else echo 'red'; ?>">{{$januaricek}}</td>

  <?php
  $febcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Februari')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($febcek <> 0) echo 'green'; else echo 'red'; ?>">{{$febcek}}</td>

  <?php
  $Marcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Maret')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Marcek <> 0) echo 'green'; else echo 'red'; ?>">{{$Marcek}}</td>

  <?php
  $Aprcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','April')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Aprcek <> 0) echo 'green'; else echo 'red'; ?>">{{$Aprcek}}</td>

  <?php
  $Meicek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Mei')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Meicek <> 0) echo 'green'; else echo 'red'; ?>">{{$Meicek}}</td>

  <?php
  $juncek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Juni')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($juncek <> 0) echo 'green'; else echo 'red'; ?>">{{$juncek}}</td>

  <?php
  $julcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Juli')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($julcek <> 0) echo 'green'; else echo 'red'; ?>">{{$julcek}}</td>

  <?php
  $Agcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Agustus')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Agcek <> 0) echo 'green'; else echo 'red'; ?>">{{$Agcek}}</td>

  <?php
  $Sepcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','September')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Sepcek <> 0) echo 'green'; else echo 'red'; ?>">{{$Sepcek}}</td>

  <?php
  $Oktcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Oktober')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Oktcek <> 0) echo 'green'; else echo 'red'; ?>">{{$Oktcek}}</td>

  <?php
  $Novcek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','November')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Novcek <> 0) echo 'green'; else echo 'red'; ?>">{{$Novcek}}</td>

  <?php
  $Descek = App\TarifBulanModel::where('idsekolahtarif',$idsek)->where('bayar_bulanan.nis',$ds->nis)
                ->where('tbl_bulan.bulan','Desember')
                ->where('id_jenispayment',$value->id_jenispayment)
                ->where('tarif_bulanan.id_kelas',$id_kelas)
                ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                ->join('tbl_bulan','tbl_bulan.id_bulan','=','tarif_bulanan.id_bulan')
                ->count();

   ?>
  <td style="color:white;background-color:<?php if($Descek <> 0) echo 'green'; else echo 'red'; ?>">{{$Descek}}</td>


</tr>
@endforeach

@endforeach
</table>
<br><br>

<table>
  <th style="width:400px;" >Mengetahui,
    <br>Kepala Sekolah
    <br><br><br><br>
    {{$sekolah->nm_kepsek}}<br>
    NIP. {{$sekolah->nipkepsek}}
  </th>
  <th style="width:400px;">
    <br>Bendahara Sekolah
    <br><br><br><br>
    {{$sekolah->bendahara}}<br>
    NIP. {{$sekolah->nipbendahara}}
  </th>
</table>
<br><br><br><br><br><br><br><br>
NB : (Hijau) Menunjukan Sudah Dibayar, (Merah) Belum Dibayar.


</body>

</html>
