<?php
$id  = $spt->id_notadinas;
$notadinas = App\NotaModel::Where('id_notadinas',$id)->first();
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
                                  ?>
<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Surat Perintah Tugas</title>

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
/*headerkopsurat */
.headerkop{
  position: relative;
  margin-left: 20px;
  margin-right: 60px;
  z-index: 1;

}
.fontnormal{
  font-family: Arial;
  font-weight:normal;
  font-size: 12pt;
  text-align: justify;
}
.tablfontnormal{
  font-family: Arial;
  font-size:18px;
  text-align:left;
  font-weight:normal;
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

hr.new1 {
  border-top: 3px solid black;
  margin-bottom: 0px;
}
hr.new2 {
  margin-top: 1px;
  border-bottom: 1px solid black;
}
br.SPT {
   display: block;
   font-size:2px;
   line-height: 2em;
   margin-bottom: 2em;
}
/*untuk body surat */
.bodysurat{
  margin-top: 12px;
  font-size: 12pt;
  text-align: justify;
}
/*Table Surat*/
.tabelsurat {
  border-collapse: collapse;
  width: 100%;
}
.tdsurat{
  border: 1px solid black;
  text-align: left;
  padding: 8px;
  font-family: Arial;
  font-weight:normal;
  font-size: 12pt;
}
.thsurat{
  border: 1px solid black;
  text-align: center;
  padding: 8px;
  font-family: Arial;
  font-weight:normal;
  font-size: 12pt;
}
</style>
</head>
<script>
function myFunction() {
  window.print();
}
</script>
<body onload="myFunction()">

    <table style="padding-top:0px;">

      <tr>
        <th class="customers">
          <image style="width:80px;height:110px;" src="{{asset("images/logo/$instansi->logo")}}"></th>
        <th align="center" headers="name" colspan="3">
          <div class="headerkop">
            <font size="4"  face="verdana">{{$instansi->pemerintahan}}</font><br>
            <font size="5,9"  face="verdana">DINAS KOMUNIKASI, INFORMATIKA DAN
              STATISTIK</font>
            <br><font size="4" class="fontnormal">{{$instansi->alamat}}</font><br>
            <font size="4" class="fontnormal">E-mail : {{$instansi->email}}</font>

        </div>
        </th>
      </tr>


</table>
<hr class="new1" >
<hr class="new2" >


<center>
<table style="text-align:center">
<tr>
  <th style="font-family: Arial;font-size:14pt">
    <u><center>SURAT PERINTAH TUGAS</center></u>
  </th>
</tr>

<tr>
  <td style="font-family: Arial;font-size:12pt;margin-top:100px;" valign="top">
  Nomor : {{$spt->nospt}}
  </td>
</tr>

</table>
<br>
</center>
<br>
<table class="tablfontnormal">
<tr style="">
<th rowpan="2"class="fontnormal" valign="top">Dasar</th>
<th class="fontnormal" valign="top" style="padding-left:8px;">:</th>
<th class="fontnormal" valign="top" style="padding-left:10px">Nota Dinas {{$notadinas->dari}} Nomor : {{$notadinas->nomor}},tanggal {{tgl_indo($notadinas->tanggal)}}, hal {{$notadinas->hal}}.</th>


</tr>

<tr>
<th class="fontnormal" valign="top"style="padding-top:25px;">Kepada</th>
<th class="fontnormal" valign="top" style="padding-left:8px;padding-top:25px;">:</th>
<th class="fontnormal" valign="top" style="padding-left:8px">
  <table>
    <?php
    $nip     = explode(",",$notadinas->nip);
    $pegawai = App\PegawaiModel::whereIn('id_pegawai',$nip)->get();

     ?>
     @foreach ($pegawai as $index => $val)
    <tr>
      <td valign="top" style="padding-top:22px;">{{$index+1}}.</td>
      <td style="padding-top:22px;padding-left:20px;">Nama</td>
      <td style="padding-top:22px;padding-left:60px;">:</td>
      <td style="padding-top:22px;padding-left:10px;">{{$val->nama}}</td>
    </tr>
    <tr>
      <td></td>
      <td style="padding-left:20px;">NIP</td>
      <td style="padding-left:60px;">:</td>
      <td style="padding-left:10px;">{{$val->nip}}</td>
    </tr>
    <tr>
      <td></td>
      <td style="padding-left:20px;">Pangkat/Gol</td>
      <td  style="padding-left:60px;">:</td>
      <td style="padding-left:10px;">{{$val->jenis_pangkat}} {{$val->golongan}}</td>
    </tr>
    <tr>
      <td valign="top"></td>
      <td valign="top" style="padding-left:20px;">Jabatan</td>
      <td valign="top" style="padding-left:60px;">:</td>
      <td valign="top" style="padding-left:10px;">{{$val->jabatan}}</td>
    </tr>
    @endforeach




  </table>
</th>


</tr>

<tr>
<th class="fontnormal" valign="top" style="padding-top:25px;">Untuk</th>
<th class="fontnormal" valign="top" style="padding-left:8px;padding-top:25px;">:</th>
<th class="fontnormal" valign="top" style="padding-left:8px;">
<table>
  <tr>
    <td valign="top" style="padding-top:22px;">1.</td>
    <td valign="top" style="padding-top:22px;padding-left:20px;">Melakukan Perjalanan dinas ke {{$spt->tujuan}} {{$spt->dalamrangka}}</td>
  </tr>
</table>
<table>
  <tr>
    <td valign="top" style="padding-top:20px;">2.</td>
    <td valign="top" style="width:200px;padding-left:20px;padding-top:20px;">Lamanya Perjalanan dinas :</td>


        <td valign="top" style="padding-top:20px;">
          <?php
          $tglawal = $spt->awal_tgl;
           ?>
          {{$spt->lamaperjalanan}} <br>Dari tanggal {{substr($tglawal,-2)}} s/d {{tgl_indo($spt->akhir_tgl)}}
        </td>


  </tr>
</table>
<table>
  <tr>
    <td valign="top" style="padding-top:20px;">3.</td>
    <td valign="top" style="padding-left:20px;padding-top:20px;">Setelah melakukan tugas paling lama 5 (lima) hari menyampaikan laporan tertulis kepada pimpinan.</td>
  </tr>
</table>
</th>
</tr>


</table>
<br>
<br>
<br>
<table class="fontnormal" style="float:right;margin-right:34px;margin-left:350px;">
  <tr>
    <th class="fontnormal" style="text-align:left;">
     Ditetapkan di Bengkalis
    </th>
  </tr>
  <tr>
    <th class="fontnormal" style="text-align:left;">
     pada tanggal {{tgl_indo($spt->tgl_penetapan)}}
    </th>
  </tr>
  <tr>
    <th class="fontnormal" style="text-align:left;">
     {{$spt->jabatan_ttd}}
    </th>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>



  <tr>
    <td class="fontnormal" style="text-align:left;">
        <u>
          <?php
          $ttd = App\PegawaiModel::where('id_pegawai',$spt->id_pegawai)->first();
           ?>
          {{$ttd->nama}}
        </u>
    </td>
  </tr>
  <tr>
    <td class="fontnormal" style="text-align:left;">
       {{$ttd->jenis_pangkat}}
    </td>
  </tr>
  <tr>
    <td class="fontnormal" style="text-align:left;">
        NIP.  {{$ttd->nip}}
    </td>
  </tr>
</table>






</body>

</html>
