@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Kelas

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
                <th>Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)

              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->kelas}}</td>
                <td>
                  <?php
                    $check = App\SiswaModel::where('id_kelas',$value->id_kelas)->count();
                    print $check;
                   ?>
                   Orang
                </td>
                <td>
                  <?php
                  $idpos = base64_encode($value->id_kelas);
                   ?>
                  <a href="{{url("/datamaster/datakelas/edit/$idpos")}}" class="btn btn-warning"> <i class="fa fa-pencil"></i></a>
                  <button class="btn btn-danger" onclick="konfirmasi({{$value->id_kelas}})"><i class="fa fa-trash"></i></button>
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
                      window.location = '{{url("delkelas")}}/'+id;

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
                <center><h3>Tambah Data Kelas</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
              <form class="forms-sample" action="{{url('/tambahkelas')}}" method="post">{{csrf_field()}}
                  <div class="date-picker-inner">
                      <div class="form-group data-custon-pick" id="data_1">
                          <label>(*) Menunjukan Data Wajib Diisi</label>
                      </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Nama Kelas</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                  <input name="kls" class="form-control" required="" type="text" placeholder="*Nama Kelas">
                              </div>
                        </div>

                          <div class="form-group data-custon-pick" id="data_2">
                                <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <button class="btn btn-warning widget-btn-1 btn-sm" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button class="btn btn-success widget-btn-1 btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
                                </div>
                         </div>

                </div>
              </form>
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
