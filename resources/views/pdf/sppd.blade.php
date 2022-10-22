<?php
$id        = $spt->id_notadinas;
$idspt     = $spt->id_spt;
$sppd      = App\SPPDModel::Where('id_spt',$idspt)->first();
$notadinas = App\NotaModel::Where('id_notadinas',$id)->first();
$tgl       = date('Y-m-d');
$tahun     = date('Y');
$kodeSPPD  =App\BidangModel::Where('id_bidang',$notadinas->id_bidang)->first();
//lop pegawai
$kar     = App\NotaModel::Where('id_notadinas',$id)->first();
$nip     = explode(",",$kar->nip);
$pegawai = App\PegawaiModel::whereIn('id_pegawai',$nip)->get();
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
  <title>SPPD</title>

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
  margin-left: 34px;
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
  font-size:11pt;
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
hr.new3 {
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
.itemtable{
   border-collapse: collapse;
}
#ta{
  border-collapse: separate;
}

</style>
</head>
<script>
function myFunction() {
  window.print();
}
</script>
<body onload="myFunction()">


@foreach ($pegawai as $index => $peg)
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

<table style="float:right;margin-right:220px;" class="tablfontnormal">
  <tr>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td>Lembaran ke</td>
    <td>:</td>
    <td></td>
  </tr>
  <tr>
    <td>Kode No</td>
    <td>:</td>
    <td></td>
  </tr>
  <tr>
    <td>Nomor</td>
    <td>:</td>
    <td></td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<center>
<table style="text-align:center">
<tr>
  <th style="font-family: Arial;font-size:12pt">
    <u><center>SURAT PERINTAH PERJALANAN DINAS</center></u>
  </th>
</tr>

<tr>
  <td style="font-family: Arial;font-size:12pt;margin-top:100px;" valign="top">
  <b>(SPPD)</b>
  </td>
</tr>

</table>

</center>
<br>
<table id="spt"class="tablfontnormal itemtable" >
<tr style="border-top: 1px solid black;">
  <th></th>
  <th></th>
  <th></th>
</tr>
<tr style="border-top: 1px solid black;">
  <td valign="top">1. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">Pejabat yang memberi Perintah</td>
  <td valign="top" style="text-align:justify;padding-left:8px;">{{$spt->jabatan_ttd}}</td>
</tr>
<tr style="border-top: 1px  solid black;">
  <td valign="top">2. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">Nama/NIP Pegawai yang diperintahakan</td>
  <td valign="top" style="text-align:justify;padding-left:8px;">{{$peg->nama}}/{{$peg->nip}}</td>
</tr>
<tr style="border-top: 1px  solid black;">
  <td valign="top" style="padding-top:4px;">3. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td valign="top">a. </td>
      <td valign="top">Pangkat dan Golongan menurut PP No. 6 Tahun 1997</td>
    </tr>
    <tr>
      <td valign="top">b. </td>
      <td valign="top">Jabatan</td>
    </tr>
    <tr>
      <td valign="top" style="padding-top:50px;">c. </td>
      <td valign="top" style="padding-top:50px;">Tingkat menurut peraturan perjalanan</td>
    </tr>
  </table>
  </td>
  <td valign="top">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
    </tr>
    <tr>
      <td valign="top" style="text-align:justify;padding-left:8px;">{{$peg->jenis_pangkat}} {{$peg->golongan}}</td>
    </tr>
    <tr>
    <td valign="top" style="text-align:justify;padding-left:8px;padding-top:16px;">{{$peg->jabatan}}</td>
    </tr>
    <tr>
    <td valign="top" style="text-align:justify;padding-left:8px;padding-top:35px;"></td>
    </tr>
  </table>
</td>

</tr>
<tr style="border-top: 1px  solid black;">
  <td valign="top">4. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">Maksud Perjalanan Dinas</td>
  <td valign="top" style="text-align:justify;padding-left:8px;word-spacing:0px;">
    Melakukan perjalanan dinas ke {{$notadinas->tujuan}} {{$spt->dalamrangka}}
  </td>
</tr>

<tr style="border-top: 1px  solid black;">
  <td valign="top">5. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">Alat angkutan yang dipergunakan</td>
  <td valign="top" style="text-align:justify;padding-left:8px;">
    {{$sppd->transportasi}}
  </td>
</tr>


<tr style="border-top: 1px  solid black;">
  <td valign="top" style="padding-top:4px;">6. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td valign="top">a. </td>
      <td valign="top">Tempat Berangkat</td>
    </tr>
    <tr>
      <td valign="top">b. </td>
      <td valign="top">Tempat Tujuan</td>
    </tr>

  </table>
  </td>
  <td valign="top">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
    </tr>
    <tr>
      <td valign="top" style="text-align:justify;padding-left:8px;">Bengkalis</td>
    </tr>
    <tr>
    <td valign="top" style="text-align:justify;padding-left:8px;">Pekanbaru</td>
    </tr>

  </table>
</td>

</tr>

<tr style="border-top: 1px  solid black;">
  <td valign="top" style="padding-top:4px;">7. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td valign="top">a. </td>
      <td valign="top">Lama Perjalanan Dinas</td>
    </tr>
    <tr>
      <td valign="top">b. </td>
      <td valign="top">Tanggal Berangkat</td>
    </tr>
    <tr>
      <td valign="top">c. </td>
      <td valign="top">Tanggal Harus Kembali</td>
    </tr>

  </table>
  </td>
  <td valign="top">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
    </tr>
    <tr>
      <td valign="top" style="text-align:justify;padding-left:8px;">{{$spt->lamaperjalanan}}</td>
    </tr>
    <tr>
    <td valign="top" style="text-align:justify;padding-left:8px;">{{tgl_indo($spt->awal_tgl)}}</td>
    </tr>
    <tr>
    <td valign="top" style="text-align:justify;padding-left:8px;">{{tgl_indo($spt->akhir_tgl)}}</td>
    </tr>




  </table>
</td>

</tr>

<tr style="border-top: 1px  solid black;">
  <td valign="top" style="padding-top:4px;">8. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td valign="top">Pengikut</td>
    </tr>
    </table>
  </td>
  <td valign="top">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
    </tr>
    <tr>
      <td valign="top" style="text-align:justify;padding-left:8px;">{{$sppd->pengikut}}</td>
    </tr>
    </table>
</td>

</tr>

<tr style="border-top: 1px  solid black;">
  <td valign="top" style="padding-top:4px;">9. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;padding-top:4px;"> Pembayaran
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td valign="top">a. </td>
      <td valign="top">instansi</td>
    </tr>
    <tr>
      <td valign="top" style="padding-top:25px;">b. </td>
      <td valign="top" style="padding-top:25px;">Mata Anggaran</td>
    </tr>


  </table>
  </td>
  <td valign="top">
    <table class="tablfontnormal itemtable">
    <tr>
      <th></th>
    </tr>
    <tr>
      <td valign="top" style="text-align:left;padding-left:8px;padding-top:20px;word-spacing: -1px;">
        DINAS KOMUNIKASI INFORMATIKA DAN STATISTIK KABUPATEN BENGKALIS
      </td>
    </tr>
    <tr>
    <td valign="top" style="text-align:justify;padding-left:8px;padding-top:10px;">
      @if($sppd->pembayaran=='Bidang')
      <?php
          $dpa = App\DPAModel::where('id_bidang',$notadinas->id_bidang)->first();

       ?>
      {{$dpa->no_dpa}}.5.2.2.15.002
      @endif
    </td>
    </tr>





  </table>
</td>

</tr>

<tr style="border-top: 1px  solid black;border-bottom: 1px solid black;">
  <td valign="top" style="padding-top:4px;">10. </td>
  <td valign="top" style="width:290px;border-right: 1px solid black;padding-top:4px;"> keterangan lain-lain
  </td>
  <td valign="top">

</td>

</tr>

</table>
<br>


<table class="fontnormal" style="float:right;margin-right:34px;margin-left:350px;">
  <tr>
    <th class="fontnormal" style="text-align:left;">
     Ditetapkan di Bengkalis
    </th>
  </tr>
  <tr>
    <th class="fontnormal" style="text-align:left;">
     pada tanggal {{tgl_indo($sppd->sppd_tgl_penetapan)}}
    </th>
  </tr>
    @if($sppd->pembayaran=='Bidang')
    <?php
    $pegawaittd=App\PegawaiModel::
    Where('id_bidang',$notadinas->id_bidang)
    ->Where('jabatan','like','%Kepala Bidang%')
    ->first();

    ?>
  <tr>
    <th class="fontnormal" style="text-align:left;">
      {{strtoupper($pegawaittd->jabatan)}}
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




  <tr>
    <td class="fontnormal" style="text-align:left;">
        <u>{{$pegawaittd->nama}}</u>
    </td>
  </tr>
  <tr>
    <td class="fontnormal" style="text-align:left;">
        {{$pegawaittd->jenis_pangkat}}
    </td>
  </tr>
  <tr>
    <td class="fontnormal" style="text-align:left;">
        NIP.  {{$pegawaittd->nip}}
    </td>
  </tr>
  @endif
</table>




<!--visum-->

</center>
<br>


<table id="spt"class="tablfontnormal itemtable" style="page-break-before: always" >
<tr>
<th></th>
<th></th>
<th></th>
</tr>
<tr  style="border-bottom: 1px solid black;">
<td valign="top"></td>
<td valign="top" style="width:290px;"></td>
<td valign="top" style="text-align:justify;width:100%;padding-left:240px;">
  <table class="fontnormal">
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td rowspan="6" valign="top" style="padding-left:100px;">I.</td>
      <td style="padding-left:2px;">SPPD No.</td>
      <td>:</td>
      <td>{{$kodeSPPD->bidang}}/SPPD/{{$tahun}}/</td>
    </tr>
    <tr>
      <td style="padding-left:2px;">Berangkat dari</td>
      <td>:</td>
      <td> Bengkalis</td>
    </tr>
    <tr>
      <td style="padding-left:2px;">(tempat kedudukan)</td>
      <td>:</td>
      <td></td>
    </tr>
    <tr>
      <td style="padding-left:2px;">Pada tanggal</td>
      <td>:</td>
      <td>{{tgl_indo($spt->awal_tgl)}}</td>
    </tr>
    <tr>
      <td style="padding-left:2px;">Ke</td>
      <td>:</td>
      <td>{{$notadinas->tujuan}}</td>
    </tr>
    <tr>
      <td style="padding-left:2px;padding-bottom:20px;" colspan="3">Selaku Pelaksana Teknis Kegiatan.</td>
    </tr>
  </table>
</td>
</tr>
<!--Rata kiri-->
<tr  style="border-bottom: 1px solid black;">
<td valign="top"></td>
<td valign="top" style="width:290px;"></td>
<td valign="top" style="text-align:justify;width:100%;padding-bottom:90px;">
  <table class="fontnormal">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
  <td valign="top">
    <table class="fontnormal">
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <td rowspan="6" valign="top" style="padding-left:1px;">II.</td>
        <td style="padding-left:2px;">Tiba di</td>
        <td>:</td>
        <td>{{$notadinas->tujuan}}</td>
      </tr>
      <tr>
        <td style="padding-left:2px;">Pada tanggal</td>
        <td>:</td>
        <td>{{tgl_indo($spt->awal_tgl)}}</td>
      </tr>
      <tr>
        <td style="padding-left:2px;">Kepala</td>
        <td>:</td>
        <td></td>
      </tr>


    </table>
      </td>
  <td valign="top" style="padding-left:60px;">
        <table valign="top" class="fontnormal">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td rowspan="6" valign="top" style="padding-left:60px;"></td>
            <td style="padding-left:2px;">Berangkat dari</td>
            <td>:</td>
            <td>{{$notadinas->tujuan}}</td>
          </tr>
          <tr>
            <td style="padding-left:2px;">ke</td>
            <td>:</td>
            <td>Bengkalis</td>
          </tr>
          <tr>
            <td style="padding-left:2px;">Pada tanggal</td>
            <td>:</td>
            <td>{{tgl_indo($spt->akhir_tgl)}}</td>
          </tr>
          <tr>
            <td style="padding-left:2px;">Kepala</td>
            <td>:</td>
            <td></td>
          </tr>

        </table>
  </td>
    </tr>

  </table>
</td>
</tr>

<tr  style="border-bottom: 1px solid black;">
<td valign="top"></td>
<td valign="top" style="width:290px;"></td>
<td valign="top" style="text-align:justify;width:100%;padding-bottom:90px;">
  <table class="fontnormal">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
  <td valign="top">
    <table class="fontnormal">
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <td rowspan="6" valign="top" style="padding-left:1px;">III.</td>
        <td style="padding-left:2px;">Tiba di</td>
        <td>:</td>
        <td></td>
      </tr>
      <tr>
        <td style="padding-left:2px;">Pada tanggal</td>
        <td>:</td>
        <td></td>
      </tr>
      <tr>
        <td style="padding-left:2px;">Kepala</td>
        <td>:</td>
        <td></td>
      </tr>


    </table>
      </td>
  <td valign="top" style="padding-left:160px;">
        <table valign="top" class="fontnormal">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td rowspan="6" valign="top" style="padding-left:60px;"></td>
            <td style="padding-left:2px;">Berangkat dari</td>
            <td>:</td>
            <td> Pekanbaru</td>
          </tr>
          <tr>
            <td style="padding-left:2px;">ke</td>
            <td>:</td>
            <td></td>
          </tr>
          <tr>
            <td style="padding-left:2px;">Pada tanggal</td>
            <td>:</td>
            <td></td>
          </tr>
          <tr>
            <td style="padding-left:2px;">Kepala</td>
            <td>:</td>
            <td></td>
          </tr>

        </table>
  </td>
    </tr>

  </table>
</td>
</tr>

<tr  style="border-bottom: 1px solid black;">
<td valign="top"></td>
<td valign="top" style="width:290px;"></td>
<td valign="top" style="text-align:justify;width:100%;padding-bottom:90px;">
  <table class="fontnormal">
    <tr>
      <th></th>
      <th></th>
    </tr>
    <tr>
  <td valign="top">
    <table class="fontnormal">
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <td rowspan="6" valign="top" style="padding-left:1px;">IV.</td>
        <td style="padding-left:2px;">Tiba di</td>
        <td>:</td>
        <td></td>
      </tr>
      <tr>
        <td style="padding-left:2px;">Pada tanggal</td>
        <td>:</td>
        <td></td>
      </tr>
      <tr>
        <td style="padding-left:2px;">Kepala</td>
        <td>:</td>
        <td></td>
      </tr>


    </table>
      </td>
  <td valign="top" style="padding-left:160px;">
        <table valign="top" class="fontnormal">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td rowspan="6" valign="top" style="padding-left:60px;"></td>
            <td style="padding-left:2px;">Berangkat dari</td>
            <td>:</td>
            <td> Pekanbaru</td>
          </tr>
          <tr>
            <td style="padding-left:2px;">ke</td>
            <td>:</td>
            <td></td>
          </tr>
          <tr>
            <td style="padding-left:2px;">Pada tanggal</td>
            <td>:</td>
            <td></td>
          </tr>
          <tr>
            <td style="padding-left:2px;">Kepala</td>
            <td>:</td>
            <td></td>
          </tr>

        </table>
  </td>
    </tr>

  </table>
</td>
</tr>


</table>
<br>


<!--TTD-->

<table id="spt"class="tablfontnormal itemtable">
<tr>
<th></th>
<th></th>
<th></th>
</tr>
<tr>
<td valign="top"></td>
<td valign="top" style="width:290px;"></td>
<td valign="top" style="text-align:justify;width:100%;padding-left:200px;">
  <table class="fontnormal">
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <td rowspan="6" valign="top" style="padding-left:100px;">V.</td>
      <td style="padding-left:30px;">Tiba Kembali di</td>
      <td>:</td>
      <td> Bengkalis</td>
    </tr>
    <tr>
      <td style="padding-left:30px;">Pada tanggal</td>
      <td>:</td>
      <td> {{tgl_indo($sppd->sppd_tgl_penetapan)}}</td>
    </tr>

    <tr>
      <td style="text-align:justify;padding-left:30px;padding-top: 20px;padding-bottom:20px;" colspan="3">
        Telah diperikasa, dengan keterangan bahwa perjalanan tersebut diatas benar
        dilakukan atas perintah dan semata-mata untuk kepentingan jabatan dalam waktu
        yang sesingkat-singkatnya.
      </td>
    </tr>
    <tr>
      <td style="padding-left:50px;text-align:left;"></td>
    </tr>
  </table>
</td>
</tr>
</table>
@if($sppd->pembayaran=='Bidang')
<?php
$pegawaittd=App\PegawaiModel::
Where('id_bidang',$notadinas->id_bidang)
->Where('jabatan','like','%Kepala Bidang%')
->first();

?>
<table style="margin-left:390px;"class="tablfontnormal">
<tr>
    <th></th>
</tr>
<tr>
  <td>{{strtoupper($pegawaittd->jabatan)}}</td>
</tr>
<tr>
  <td style="padding-top:60px;">{{$pegawaittd->nama}}</td>
</tr>
<tr>
  <td>NIP. {{$pegawaittd->nip}}</td>
</tr>
</table>
@endif
<table class="tablfontnormal itemtable" style="width:100%">
  <tr style="border-top: 1px  solid black;">
    <th></th>
    <th></th>
  </tr>
  <tr style="border-bottom: 1px  solid black;padding-top:2px;padding-bottom:2px;">
    <td>VI.</td>
    <td style="padding-right:300px;">CATATAN LAIN-LAIN</td>
  </tr>
  <tr style="padding-top:2px;">
    <td>VII.</td>
    <td>PERHATIAN</td>
  </tr>
  <tr>
    <td></td>
    <td>Pejabat yang berwenang menerbitkan SPPD,
       pegwai yang melakukan perjalanan dinas, para pejabat mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab Berdasarkan
       perauran-peraturan keuangan Negara apabila Negara mendapat rugi akibat kesalahan, kealpaannya
    </td>
  </tr>

</table>




@endforeach
<!--End looping data Pegawai-->




</body>

</html>
