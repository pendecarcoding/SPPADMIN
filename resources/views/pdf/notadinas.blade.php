<?php
$id  = $nota->id_notadinas;
$kar = App\NotaModel::Where('id_notadinas',$id)->first();
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
  <title>NotaDinas</title>

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
hr.garissurat {

  border-bottom: 1px solid black;
  margin-right: 50px;
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




  <u><h3 style="font-family: Arial;"><center>NOTA DINAS</center></h3></u>
  <table class="tablfontnormal">
<tr>
<th class="fontnormal">Kepada Yth</th>
<th class="fontnormal">:</th>
<th class="fontnormal">{{$nota->kepada}}</th>


</tr>

<tr>
<th class="fontnormal">Dari</th>
<th class="fontnormal">:</th>
<th class="fontnormal">{{$nota->dari}}</th>


</tr>

<tr>
<th class="fontnormal">Tanggal</th>
<th class="fontnormal">:</th>
<th class="fontnormal">{{tgl_indo($nota->tanggal)}}</th>
</tr>

<tr>
<th class="fontnormal">Nomor</th>
<th class="fontnormal">:</th>
<th class="fontnormal">{{($nota->nomor)}}</th>
</tr>

<tr>
<th class="fontnormal">Hal</th>
<th class="fontnormal">:</th>
<th class="fontnormal">{{($nota->hal)}}</th>


</tr>
</table>
<hr class="garissurat">
<div style="text-indent:2.5em;" class="bodysurat fontnormal">
  {{strip_tags($nota->isi)}}
  <br>
</div>
<div style="text-indent:2.5em;" class="bodysurat fontnormal">
  Sehubungan dengan hal diatas, mohon persetujuan Bapak untuk dapat menerbitkan SPT kepada pegawai Dinas Komunikasi
  Informatika dan Statistik, atas nama :
</div>

<br>
<table class="tabelsurat">
  <tr>
    <th style="width:20px;" class="thsurat">No</th>
    <th class="thsurat" style="width:250px;">Nama / NIP / Pangkat / Gol</th>
    <th class="thsurat">Jabatan</th>
    <th class="thsurat">Tujuan</th>
  </tr>

<?php
$nip     = explode(",",$kar->nip);
$pegawai = App\PegawaiModel::whereIn('id_pegawai',$nip)->get();
$check   = App\PegawaiModel::whereIn('id_pegawai',$nip)->count();
?>
@foreach ($pegawai as $index =>$pg)

<tr>
    <td class="tdsurat">{{$index+1}}</td>
    <td class="tdsurat">{{$pg->nama}}<br>
    {{$pg->jenis_pangkat}} {{$pg->golongan}}<br>
    NIP . {{$pg->nip}}</td>
    <td class="tdsurat">{{$pg->jabatan}}</td>
    @if($index+1=='1')

      <td rowspan="{{$check}}"class="tdsurat">{{$nota->tujuan}}</td>

    @else


    @endif

  </tr>
  @endforeach



</table>
<div style="text-indent:2.5em;" class="bodysurat fontnormal">
  Demikian disampaikan, atas persetujuan Bapak Kami aturkan terima kasih.
</div>
<br>
<br>
<table class="fontnormal" style="float:right;margin-right:34px;margin-left:350px;">
  <tr>
    <th class="fontnormal" style="text-align:left;">
     {{$nota->jbtn_ttd}}
    </th>
  </tr>
  <br/>

  <tr>
    <td class="fontnormal" style="text-align:left;padding-top:90px;">
        <font style="text-decoration: underline; text-underline-position:under;">{{$nota->nama}}</font>
    </td>
  </tr>
  <tr>
    <td class="fontnormal" style="text-align:left;">
        {{$nota->jenis_pangkat}}
    </td>
  </tr>
  <tr>
    <td class="fontnormal" style="text-align:left;">
        NIP.  {{$nota->nip}}
    </td>
  </tr>
</table>






</body>

</html>
