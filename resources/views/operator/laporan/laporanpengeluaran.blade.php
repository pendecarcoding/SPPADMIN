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
    $kategori = App\JenispengeluaranModel::where('idkatsekolah',$idsek)->get();


    $totjuk = App\PengeluaranModel::where('idsekolahkeluar',$idsek)->whereBetween('tanggal',[$tgl_awal,$tgl_akhir])->sum('nominal');

    $sekolah = App\SekolahModel::where('id_sekolah',$idsek)->first();

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




<h3>Laporan penggunaan Dana</h3>
<table>
  <tr>
  <th>Periode</th>
  <th>:</th>
  <th>{{tgl_indo($tgl_awal).' - '.tgl_indo($tgl_akhir)}}</th>
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
<th>Pengeluaran</th>
<th>MA</th>
<th>Uraian</th>
<th>Nominal</th>


</tr>



</tr>

<?php foreach ($kategori as $key => $d): ?>

<?php
$id = $d->id_katpengeluaran;
$cek = App\PengeluaranModel::where('idsekolahkeluar',$idsek)->whereBetween('tanggal',[$tgl_awal,$tgl_akhir])
        ->where('pengeluaran.id_katpengeluaran',$id)
        ->join('kat_pengeluaran','kat_pengeluaran.id_katpengeluaran','=','pengeluaran.id_katpengeluaran')
        ->count('penggunaan');

        $pengeluaran = App\PengeluaranModel::where('idsekolahkeluar',$idsek)->whereBetween('tanggal',[$tgl_awal,$tgl_akhir])
                ->where('pengeluaran.id_katpengeluaran',$id)
                ->join('kat_pengeluaran','kat_pengeluaran.id_katpengeluaran','=','pengeluaran.id_katpengeluaran')
                ->get();


 ?>


<?php
if($cek > 1){
  ?>
  <tr>
      <td rowspan="<?php echo $cek+1 ?>">{{$key+1}}</td>
      <td rowspan="<?php echo $cek+1 ?>">{{$d->katpengeluaran}}</td>

  </tr>
  <?php $no=1; ?>
@foreach ($pengeluaran as $dey => $pe)

<tr>
  <td>{{$key+1}}.{{$no++}}</td>
  <td>{{$pe->penggunaan}}</td>
  <td>Rp {{number_format($pe->nominal)}}</td>
</tr>
@endforeach


  <?php
}
else if ($cek == 1 AND $cek <> 0){
  ?>
  <?php $no=1; ?>
  @foreach ($pengeluaran as $dey => $pe)

  <tr>
    <td>{{$key+1}}</td>
    <td>{{$d->katpengeluaran}}</td>
    <td>{{$key+1}}.{{$no++}}</td>
    <td>{{$pe->penggunaan}}</td>
    <td>Rp {{number_format($pe->nominal)}}</td>
  </tr>
  @endforeach
  <?php
}
else{
  ?>
  <tr>
    <td>{{$key+1}}</td>
    <td>{{$d->katpengeluaran}}</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <?php
}
 ?>


@endforeach
<tr>
     <td colspan="5"><B>Total Penggunaan Dana ( Rp {{number_format($totjuk)}} )</B></td>



</tr>

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
