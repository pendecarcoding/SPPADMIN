@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->
<?php
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
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pengeluaran

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-8">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">

          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Penggunaan</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)

              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->katpengeluaran}}</td>
                <td>{{$value->penggunaan}}</td>
                <td>Rp {{number_format($value->nominal)}}</td>
                <td>{{tgl_indo($value->tanggal)}}</td>
                <td>{{$value->tahun}}</td>
                <td>
                  <?php
                  $idpe = base64_encode($value->id_pengeluaran);
                   ?>
                  <a href="{{url("/jurnalumum/pengeluaran/edit/$idpe")}}" class="btn btn-warning"> <i class="fa fa-pencil"></i></a>
                  <button class="btn btn-danger" onclick="konfirmasi({{$value->id_pengeluaran}})"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
              <script>
                  function konfirmasi(id){

                  swal({   title: "Anda yakin hapus data ini?",
                  text: "Data yang terhapus tidak dapat di kembalikan !!!",   type: "warning",
                  showCancelButton: true,   confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya, hapus data!",   closeOnConfirm: false
                  },
                  function(){   swal("data dihapus!", "", "success")
                      window.location = '{{url("deletepengeluaran")}}/'+id;

                    }



                    );

                    }

                  </script>
              @endforeach

              </tbody>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-xs-4">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <div class="main-sparkline16-hd">
              <a style="float:right;" href="{{url('/jurnalumum/pengeluaran/')}}" class="btn btn-danger">X</a>
                <center><h3>Edit Data Pengeluaran</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
                              <form class="forms-sample" action="{{url('/updatepengeluaran')}}" method="post">{{csrf_field()}}
                                <div class="date-picker-inner">
                                    <div class="form-group data-custon-pick" id="data_1">
                                        <label>(*) Menunjukan Data Wajib Diisi</label>

                                    </div>
                                    <div class="form-group data-custon-pick" id="data_2">
                                        <label>Kategori Pengeluaran</label>
                                          <input type="hidden" name="id" value="{{$e->id_pengeluaran}}">
                                          <select style="background-color:#3e3e3e;color:white;" name="idkategori" tabindex="-1" class="form-control" required="" data-placeholder="Pilih Kelas">
                                              <option value="">--Pilih Kategori--</option>
                                              @foreach($j as $index => $kat)
                                                <option value="{{$kat->id_katpengeluaran}}" @if($kat->id_katpengeluaran==$e->id_katpengeluaran)selected @endif>{{$kat->katpengeluaran}}</option>
                                              @endforeach
                                          </select>

                                    </div>
                                    <div class="form-group data-custon-pick" id="data_2">
                                        <label>Kegunaan</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                            <input style="background-color:#3e3e3e;color:white;" name="kegunaan" value="{{$e->penggunaan}}" class="form-control" required="" type="text" placeholder="*Kegunaan">
                                        </div>
                                    </div>
                                    <div class="form-group data-custon-pick" id="data_2">
                                        <label>Nominal</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                            <input style="background-color:#3e3e3e;color:white;" name="nominal" value="{{$e->nominal}}" class="form-control" required="" type="number" placeholder="*Nominal">
                                        </div>
                                    </div>
                                    <div class="form-group data-custon-pick" id="data_2">
                                        <label>Tanggal Pengeluaran</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            <input style="background-color:#3e3e3e;color:white;" name="tanggal" value="{{$e->tanggal}}" class="form-control" required="" type="date" placeholder="*Tanggal">
                                        </div>
                                    </div>
                                    <div class="form-group data-custon-pick" id="data_2">

                                      <div class="chosen-select-single mg-b-20">
                                          <label>Tahun Ajaran</label>
                                          <select style="background-color:#3e3e3e;color:white;" name="idtahun" data-placeholder="Pilih Kelas" class="form-control" tabindex="-1" required>
                                              <option value="">--Pilih Tahun Ajaran--</option>
                                            @foreach ($tahun as $key => $th)
                                              <option value="{{$th->id_tahun}}" @if($th->id_tahun==$e->id_tahun)selected @endif>{{$th->tahun}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    <div class="form-group data-custon-pick" id="data_2">



                                    <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                      <button class="btn btn-warning widget-btn-1 btn-sm" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                      <button class="btn btn-success widget-btn-1 btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
                                    </div>
                                </div>

                            </div></form>
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
