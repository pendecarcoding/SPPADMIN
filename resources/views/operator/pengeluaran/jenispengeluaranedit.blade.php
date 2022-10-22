@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Jenis Pengeluaran

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
                <th>Jenis Pengeluaran</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)

              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->katpengeluaran}}</td>
                <td>{{$value->tahun}}</td>
                <td>
                  <?php
                  $idpe = base64_encode($value->id_katpengeluaran);
                   ?>
                  <a href="{{url("/jurnalumum/jenispengeluaran/edit/$idpe")}}" class="btn btn-warning"> <i class="fa fa-pencil"></i> Edit</a>
                  <button class="btn btn-danger" onclick="konfirmasi({{$value->id_katpengeluaran}})"><i class="fa fa-trash"></i> Hapus</button>
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
              <a style="float:right;" href="{{url('/jurnalumum/jenispengeluaran')}}" class="btn btn-danger">X</a>
                <center><h3>Edit Jenis Pengeluaran</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
                            <form class="forms-sample" action="{{url('/updatejenispengeluaran')}}" method="post">{{csrf_field()}}
                              <div class="date-picker-inner">
                                  <div class="form-group data-custon-pick" id="data_1">
                                      <label>(*) Menunjukan Data Wajib Diisi</label>

                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Jenis Pengeluaran</label>
                                      <div class="input-group date">
                                          <input type="hidden" nmae="id" value="{{$e->id_katpengeluaran}}">
                                          <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                          <input style="background-color:#3e3e3e;color:white;" type="text" value="{{$e->katpengeluaran}}" name="jenis" class="form-control" placeholder="*Jenis Pengeluaran" required>
                                      </div>
                                  </div>

                                  <div class="form-group data-custon-pick" id="data_2">

                                    <div class="chosen-select-single mg-b-20">
                                        <label>Tahun Ajaran</label>
                                        <select style="background-color:#3e3e3e;color:white;" name="idtahun" data-placeholder="Pilih Kelas" class="form-control" tabindex="-1" required>
                                            <option value="">--Pilih Tahun Ajaran--</option>
                                          @foreach ($tahun as $key => $th)
                                            <option value="{{$th->id_tahun}}" @if($th->id_tahun==$e->id_tahun) selected @endif>{{$th->tahun}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                  </div>



                                  <div class="form-group data-custon-pick" id="data_2">



                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <button type="reset" class="btn btn-warning widget-btn-1 btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button type="submit" class="btn btn-success widget-btn-1 btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
                                  </div>
                              </div>
                            </form>
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
