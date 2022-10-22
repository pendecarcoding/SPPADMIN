<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Laporan Tunggakan Bebas Bulanan</title>

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
                                    $sekolah = App\SekolahModel::where('id_sekolah',$idsek)->first();
                                    $tahunajaran  = App\TahunModel::where('id_tahun',$id_tahun)->first();
                                    $kelas        = App\KelasModel::where('id_sekolahkelas',$idsek)->where('id_kelas',$id_kelas)->first();
                                    $siswa     = App\SiswaModel::where('id_sekolahsiswa',$idsek)->where('id_kelas',$id_kelas)->get();
                                    ?>

    <table>
  <tr>
    <th><img style="width:100px;height:100px;" src="{{ public_path("/images/logo/$sekolah->logo")}}"></th>
    <th colspan="3">
      <font size="5" face="verdana">{{$sekolah->nm_sekolah}}</font>
      <br><font size="3" type="verdana">{{$sekolah->al_sekolah}} Telp {{$sekolah->nohp}}</font><br>
      <font size="3" type="verdana">Website : {{$sekolah->website}} Email: {{$sekolah->email}}</font>
    </th>
  </tr>


  </table>
<hr>




<h3>Laporan Tunggakan NON Bulanan</h3>
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
<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Tagihan</th>


</tr>


@foreach ($siswa as $index => $sis)
<tr>
    <td>{{$index+1}}</td>
    <td>{{$sis->nis}}</td>
    <td>{{$sis->nama}}</td>
    <td>
      <?php
      $tarifbebas = App\TarifBebasModel::where('idsekolahbebas',$idsek)->where('tbl_jenispayment.id_tahun',$id_tahun)
      ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
      ->sum('tarifbebas');
      $sudahbayar = App\BayarBebasModel::where('idsekolahbe',$idsek)->where('nis',$sis->nis)
      ->where('tbl_jenispayment.id_tahun',$id_tahun)
      ->join('tarif_bebas','tarif_bebas.id_tarifbebas','=','bayar_bebas.id_tarifbebas')
      ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
      ->sum('jumlah_bayar');

      if($tarifbebas <> $sudahbayar OR $sudahbayar != 0){
        $hasil = 'Belum Lunas';
      }
      if($tarifbebas == 0 AND $sudahbayar == 0 ){
        $hasil = 'Tidak ada tagihan';
      }
      if($sudahbayar > 0 AND $tarifbebas == $sudahbayar){
        $hasil = 'Lunas';
      }

     ?>

      {{$hasil}}

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
