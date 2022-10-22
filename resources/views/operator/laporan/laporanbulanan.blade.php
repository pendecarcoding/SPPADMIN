@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laporan Bulanan

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <div class="col-md-4">
              <a data-toggle="modal" data-target="#PrimaryModalalert"class="btn btn-success"><i class="fa fa-print"></i> Cetak data Pemasukan</a>
              <div id="PrimaryModalalert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">

                                            <div class="modal-close-area modal-close-df">
                                                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                            </div>
                                          </div>

                                            <form method="post" action="{{url('/laporan/laporanpenerimaan/')}}">{{csrf_field()}}
                                            <div class="modal-body">

                                                <h2>Pilih Priode Tanggal Pemasukan</h2>
                                                <label style="float:left;">Tanggal Awal</label>
                                                <input type="date" class="form-control" name="tgl_awal">
                                                <label style="float:left;">Tanggal Akhir</label>
                                                <input type="date" class="form-control" name="tgl_akhir">
                                            </div>
                                            <div class="modal-footer">
                                                <button data-dismiss="modal" href="#" class="btn btn-custon-four btn-warning">Batal</button>
                                                <button type="submit" class="btn btn-primary btn-md">Cetak</button>
                                            </div>
                                          </form>
                                        </div>
                                    </div>
                                </div>


            </div>
            <div class="col-md-4">
              <a data-toggle="modal" data-target="#pengeluaran" class="btn btn-warning"><i class="fa fa-print"></i> Cetak data Pengeluaran</a>
              <div id="pengeluaran" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                          <div class="modal-close-area modal-close-df">
                                              <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                          </div>
                                        </div>
                                          <form method="post" action="{{url('/laporan/laporanpengeluaran/')}}">{{csrf_field()}}
                                          <div class="modal-body">

                                              <h2>Pilih Priode Tanggal Pengeluaran</h2>
                                              <label style="float:left;">Tanggal Awal</label>
                                              <input type="date" class="form-control" name="tgl_awal">
                                              <label style="float:left;">Tanggal Akhir</label>
                                              <input type="date" class="form-control" name="tgl_akhir">
                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" href="#" class="btn btn-custon-four btn-warning">Batal</button>
                                              <button type="submit" class="btn btn-primary btn-md">Cetak</button>
                                          </div>
                                        </form>
                                      </div>
                                  </div>
                              </div>

            </div>
            <div class="col-md-4">
              <a data-toggle="modal" data-target="#tunggakan" class="btn btn-danger"><i class="fa fa-print"></i> Cetak data Tungakan</a>
              <div id="tunggakan" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                          <div class="modal-close-area modal-close-df">
                                              <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                          </div>
                                        </div>
                                          <form method="post" action="{{url('/laporan/laporantunggakan/')}}">{{csrf_field()}}
                                          <div class="modal-body">

                                              <h2>Form Tunggakan Siswa</h2>
                                              <label style="float:left;">Tahun Ajaran</label>
                                              <?php
                                              $idsek = Session::get('idsekolah');
                                              $tahun = App\TahunModel::all();
                                              $kelas = App\KelasModel::where('id_sekolahkelas',$idsek)->where('kelas','!=','Tamat')->get();
                                               ?>
                                              <select class="form-control" name='id_tahun'>
                                                <option>--Pilih Tahun Ajaran--</option>
                                                @foreach ($tahun as $key => $value)
                                                <option value="{{$value->id_tahun}}">{{$value->tahun}}</option>
                                                @endforeach
                                              </select>


                                              <label style="float:left;">Jenis Pembayaran</label>
                                              <select class="form-control" name='jenis'>
                                                <option>--Pilih Jenis--</option>
                                                <option value="Bulanan">Bulanan</option>
                                                <option value="Bebas">Bebas</option>
                                              </select>

                                              <label style="float:left;">Kelas</label>
                                              <select class="form-control" name='id_kelas'>
                                                <option>--Pilih Kelas--</option>
                                                @foreach ($kelas as $index => $kls)
                                                <option value="{{$kls->id_kelas}}">{{$kls->kelas}}</option>
                                                @endforeach
                                              </select>

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" href="#" class="btn btn-custon-four btn-warning">Batal</button>
                                              <button type="submit" class="btn btn-primary btn-md">Cetak</button>
                                          </div>
                                        </form>
                                      </div>
                                  </div>
                              </div>

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">


          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-xs-12">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-lg-12 col-xs-12">

            <div class="box box-primary slimscroll">
               <div class="box-body">

                    <div class="col-lg-6 col-xs-6">
                      <center><h3>Grafik Pemasukan (<?php echo date('Y'); ?>)</h3></center>
                       <div style="height:400px;" id="chartdiv"></div>
                     </div>
                     <div class="col-lg-6 col-xs-6">
                       <center><h3>Grafik Pengeluaran  (<?php echo date('Y'); ?>)</h3></center>
                       <div style="height:400px;" id="chartpengeluaran"></div>
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
