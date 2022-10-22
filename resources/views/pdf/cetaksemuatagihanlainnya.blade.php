<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bukti Pembayaran</title>

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
@foreach ($cetak as $key => $j)
@endforeach




<?php
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
  $nama = $j->nama;
  $nis = $j->nis;
  $kelas = $j->kelas;

 ?>
 <table>
   <tr>
     <th>
     </th>
     <th>
     </th>
     <th>
     </th>

   </tr>

   <tr>
     <td>Nama</td>
     <td>:</td>
     <td>{{$nama}}<td>
   </tr>
   <tr>
     <td>NIS</td>
     <td>:</td>
     <td>{{$nis}}<td>
   </tr>
   <tr>
     <td>Kelas</td>
     <td>:</td>
     <td>{{$kelas}}<td>
   </tr>
   <tr>
     <td>Bukti Pembayaran</td>
     <td>:</td>
     <td>Semua Tarif Bebas<td>
   </tr>

   <tr>
     <td>Dicetak</td>
     <td>:</td>
     <td>{{tgl_indo($tgl)}}<td>
   </tr>

   </table>
  <table id="customers">
<tr>
<th>No</th>
<th>tanggal</th>
<th>Uraian</th>
<th>Tagihan</th>
<th>Dibayar</th>
<th>Status</th>

</tr>



</tr>
@foreach ($cetak as $key => $d)


<tr>
    <td>{{$key+1}}</td>
    <td>{{tgl_indo($d->tanggal)}}</td>
    <td>{{$d->namapayment}}</td>
    <td>Rp {{number_format($d->tarifbebas)}}</td>
    <td>Rp {{number_format($d->jumlah_bayar)}}</td>
    <td>
      <?php


      $totbayar     = App\TarifBebasModel::where('tarif_bebas.id_jenispayment',$d->id_jenispayment)
                            ->where('bayar_bebas.nis',$d->nis)
                            ->join('bayar_bebas','bayar_bebas.id_tarifbebas','=','tarif_bebas.id_tarifbebas')
                            ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                      ->sum('bayar_bebas.jumlah_bayar')
                      ;

                      //echo "Rp ".number_format($totbayar);


      if($d->tarifbebas > $totbayar){
        ?>
            Belum Lunas
        <?php
      }
      else{
        ?>
          Lunas
        <?php
      }


       ?>

    </td>

</tr>

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



</body>

</html>
