@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data POS Keuangan

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
                <th>POS</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)

              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->pos}}</td>
                <td>{{$value->keterangan}}</td>
                <td>
                  <?php
                  $idpos = base64_encode($value->id_pos);
                   ?>
                  <a href="{{url("/keuangan/poskeuangan/edit/$idpos")}}" class="btn btn-warning"> <i class="fa fa-pencil"></i> Edit</a>
                  <button class="btn btn-danger" onclick="konfirmasi({{$value->id_pos}})"><i class="fa fa-trash"></i> Hapus</button>
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
                      window.location = '{{url("deletepos")}}/'+id;

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
                <center><h3>Tambah Data POS</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
              <form class="forms-sample" action="{{url('/tambahpos')}}" method="post">{{csrf_field()}}
                  <div class="date-picker-inner">
                      <div class="form-group data-custon-pick" id="data_1">
                          <label>(*) Menunjukan Data Wajib Diisi</label>
                      </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Nama POS</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                  <input name="pos" class="form-control" required="" type="text" placeholder="*Nama POS">
                              </div>
                        </div>
                        <div class="form-group data-custon-pick" id="data_2">
                             <label>Keterangan</label>
                               <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    <input name="keterangan" class="form-control" required="" type="text" placeholder="*Keterangan POS">
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
