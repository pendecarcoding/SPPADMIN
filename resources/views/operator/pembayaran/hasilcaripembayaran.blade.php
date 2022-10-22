@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pembayaran Siswa

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">


          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">


            <!--form input-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="sparkline16-list responsive-mg-b-30">
                          <div class="sparkline16-hd">
                            <a href="{{url('/pembayaran/pembayaransiswa')}}" style="float:right;"class="btn btn-danger" href="">X</a>
                              <div class="main-sparkline16-hd">
                                  <h1>Data {{$ds->nama}}</h1>
                                  <hr>
                              </div>
                          </div>
                          <div class="sparkline16-graph">
                            <form class="forms-sample" action="{{url('/admin/lihatsiswakelas/')}}" method="post">{{csrf_field()}}
                              <div class="date-picker-inner">
                                <input type="hidden"name="nis" value="{{$ds->nis}}">
                                <input type="hidden"name="idtahun" value="{{$tahun->id_tahun}}">

                                <table id="customers">

                                  <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th rowspan="6"><image style="width:300px;heigth:300px;margin:10px;border:10px outset silver;" src="{{asset("/images/siswa/$ds->foto")}}"></th>
                                  </tr>


                                  <tr>
                                  <td style="width:200px;">Tahun Ajaran</td>
                                  <td>:</td>
                                  <td style="width:60%">{{$tahun->tahun}}</td>
                                  </tr>
                                  <tr>
                                  <td style="width:200px;">NIS</td>
                                  <td>:</td>
                                  <td style="width:60%">{{$ds->nis}}</td>
                                  </tr>
                                  <tr>
                                  <td style="width:200px;">Nama Siswa</td>
                                  <td>:</td>
                                  <td style="width:60%">{{$ds->nama}}</td>
                                  </tr>
                                  <tr>
                                  <td style="width:200px;">Nama Ibu Kandung</td>
                                  <td>:</td>
                                  <td style="width:60%">{{$ds->nama_ibu}}</td>
                                  </tr>
                                  <tr>
                                  <td style="width:200px;">Kelas</td>
                                  <td>:</td>
                                  <td style="width:60%">{{$ds->kelas}}</td>
                                  </tr>



                                    <div class="form-group data-custon-pick" id="data_2">

                                      </div>
                                    </table>

                            </div>
                            <div class="date-picker-inner">

                            </div>
                          </div>
                        </div>
                      </div>

                            </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline16-list responsive-mg-b-30">
                                <div class="sparkline16-hd">
                                    <div class="main-sparkline16-hd">
                                        <h1>Tagihan Bulanan</h1>
                                        <hr>
                                    </div>
                                </div>
                                <div class="sparkline16-graph">

                                    <div class="date-picker-inner">

                                      <table id="customers">
  <tr>
    <th>No</th>
    <th>Jenis Pembayaran</th>
    <th>Total Tagihan</th>
    <th>Sudah Dibayar</th>
    <th>Status</th>
    <th>Bayar</th>
  </tr>

  @foreach ($jp as $index =>$j)
  <tr>
    <td>{{$index+1}}</td>
    <td>
      <?php
      $payment = App\PembayaranModel::where('id_jenispayment',$j->id_jenispayment)->first();
       ?>
      {{$payment->namapayment}}</td>
    <td>
      <?php
      $id      = Session::get('idsekolah');
      $idkelascheck = App\RiwayatKelasModel::where('id_tahun',$tahun->id_tahun)->where('nis',$ds->nis)->count();
      if($idkelascheck > 0){
        $idkl = App\RiwayatKelasModel::where('id_tahun',$tahun->id_tahun)->where('nis',$ds->nis)->first();
        $idkelas = $idkl->id_kelas;
      }else{
        //$idkelas = $ds->id_kelas;
      }
$tagihan = App\TarifBulanModel::where('tarif_bulanan.id_kelas',$idkelas)
                ->where('tbl_jenispayment.id_tahun',$tahun->id_tahun)
                ->where('idsekolahtarif',$id)
                ->where('tbl_jenispayment.tipe','Bulanan')
                ->where('tbl_jenispayment.id_jenispayment',$j->id_jenispayment)
                ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bulanan.id_jenispayment')
                ->sum('tarif_bulanan.harga_tarif');

                echo "Rp ".number_format($tagihan);


 ?>




    </td>
    <td>
      <?php
      $totbayar     = App\PembayaranModel::
                      where('tbl_jenispayment.id_tahun',$tahun->id_tahun)
                      ->where('tbl_siswa.nis',$ds->nis)
                      ->where('tbl_jenispayment.tipe','Bulanan')
                      ->where('tbl_jenispayment.id_jenispayment',$j->id_jenispayment)
                      ->join('tarif_bulanan','tarif_bulanan.id_jenispayment','=','tbl_jenispayment.id_jenispayment')
                      ->join('bayar_bulanan','bayar_bulanan.id_tarifbulan','=','tarif_bulanan.id_tarifbulan')
                      ->join('tbl_siswa','tbl_siswa.nis','=','bayar_bulanan.nis')
                      ->sum('bayar_bulanan.jumlah_bayar')
                      ;

                      echo "Rp ".number_format($totbayar);
       ?>
    </td>
    <td>@if($tagihan > $totbayar OR $totbayar==0){{'Belum Lunas'}}@else{{'Sudah Lunas'}}@endif</td>
    <td>
      <?php
      if($tagihan > $totbayar AND $tagihan <> 0){
        ?>
          <a class="btn btn-success" href="{{url("pembayaran/bulanan/$j->id_jenispayment/$ds->nis/$tahun->id_tahun")}}"><i class="fa fa-money"></i> Bayar</a></td>
        <?php
      }
      else{
        ?>
          <a class="btn btn-warning" href="{{url("pembayaran/bulanan/$j->id_jenispayment/$ds->nis/$tahun->id_tahun")}}"><i class="fa fa-eye"></i>Lihat</a></td>
        <?php
      }

       ?>


  </tr>
  @endforeach


</table>

                                  </div>
                                  <div class="date-picker-inner">

                                  </div>
                                </div>
                              </div>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="sparkline16-list responsive-mg-b-30">
                                          <div class="sparkline16-hd">
                                              <div class="main-sparkline16-hd">
                                                  <h1>Tagihan Lainnya</h1><a class="btn btn-warning" href="{{url("/pdf/cetaksemuatagihanlainnya/$tahun->id_tahun/$ds->nis")}}"><i class="fa fa-print"></i> Cetak Keseluruhan</a>
                                                  <hr>
                                              </div>
                                          </div>
                                          <div class="sparkline16-graph">

                                              <div class="date-picker-inner">

                                                <table id="customers">
            <tr>
              <th>No</th>
              <th>Jenis Pembayaran</th>
              <th>Total Tagihan</th>
              <th>Sudah Dibayar</th>
              <th>Status</th>
              <th>Cetak</th>
            </tr>

            @foreach ($tarifbebas as $index =>$ta)
            <tr>
              <td>{{$index+1}}</td>
              <td>
                <?php
                $paymentbebas = App\PembayaranModel::where('id_jenispayment',$ta->id_jenispayment)->first();
                 ?>
                {{$paymentbebas->namapayment}}
              </td>
              <td>
                <?php
                $id      = Session::get('idsekolah');
                $idkelascheck = App\RiwayatKelasModel::where('id_tahun',$tahun->id_tahun)->where('nis',$ds->nis)->count();
                if($idkelascheck > 0){
                  $idkl = App\RiwayatKelasModel::where('id_tahun',$tahun->id_tahun)->where('nis',$ds->nis)->first();
                  $idkelas = $idkl->id_kelas;
                }else{
                  $idkelas = $ds->id_kelas;
                }
                $tarifbebas = App\TarifBebasModel::where('tarif_bebas.id_kelas',$idkelas)
                                ->where('tarif_bebas.id_tahun',$tahun->id_tahun)
                                ->where('tbl_jenispayment.id_tahun',$tahun->id_tahun)
                                ->where('idsekolahbebas',$id)
                                ->where('tbl_jenispayment.tipe','Bebas')
                                ->where('tbl_jenispayment.id_jenispayment',$ta->id_jenispayment)
                                ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                                ->sum('tarif_bebas.tarifbebas');

                                echo "Rp ".number_format($tarifbebas);



                 ?>

              </td>
              <td>
                <?php
                $totbayarbebas  = App\TarifBebasModel::where('tbl_jenispayment.tipe','Bebas')
                                                        ->where('tbl_jenispayment.id_jenispayment',$ta->id_jenispayment)
                                                        ->where('bayar_bebas.nis',$ds->nis)
                                                        ->join('tbl_jenispayment','tbl_jenispayment.id_jenispayment','=','tarif_bebas.id_jenispayment')
                                                        ->join('bayar_bebas','bayar_bebas.id_tarifbebas','=','tarif_bebas.id_tarifbebas')
                                                        ->sum('bayar_bebas.jumlah_bayar');

                                                        echo "Rp ".number_format($totbayarbebas);

                 ?>


              </td>

              <td>
                <?php
                if($tarifbebas > $totbayarbebas)
                {
                  ?>
                    <a class="btn btn-success" data-toggle="modal" data-target="#PrimaryModalalert{{$index+1}}" href="#"><i class="fa fa-money"></i> Bayar</td>
                  <?php
                }
                else {
                  ?>

                    <a class="btn btn-warning"  href="#"><i class="fa fa-check"></i>Lunas</td>
                  <?php

                }
                ?>


                <div id="PrimaryModalalert{{$index+1}}" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">



                            <div class="modal-body">
                            <form  method="post" action="{{url('/bayarbebas/')}}">{{csrf_field()}}
                              <h4>Deskripsi Pembayaran</h4><hr>
                              <p>Pembayaran ini digunakan untuk pembayaran {{$paymentbebas->namapayment}}</p>
                              <h4>Tagihan : Rp {{number_format($tarifbebas)}}</h4>

                                    <label>Jumlah Bayar</label>
                                    <input class="form-control" type="hidden" value="{{$ta->id_tarifbebas}}" name="idtarifbebas">
                                    <input class="form-control" type="hidden" value="{{$ds->nis}}" name="nis">
                                    <input class="form-control" type="hidden" value="{{$tahun->id_tahun}}" name="idtahun">
                                    <input class="form-control" type="number" name="jumlahbayar">


                            </div>

                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning" data-dismiss="modal" href="#"> Batal</Button>
                                <button class="btn btn-success" type="submit" href="#">Bayar</Button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


            <td>
              <a class="btn btn-warning"  href="{{url("/pdf/cetaktagihanlainnya/$ta->id_jenispayment/$ds->nis/$tahun->id_tahun")}}"><i class="fa fa-print"></i> Cetak</td>
            </td>
              </tr>
            @endforeach


          </table>

                                            </div>
                                            <div class="date-picker-inner">

                                            </div>
                                          </div>
                                        </div>

                                      </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->



@endsection
