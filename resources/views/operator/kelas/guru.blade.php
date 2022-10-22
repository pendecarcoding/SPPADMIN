@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Guru

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
                <th>NIP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Hp</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $i => $v)
              <tr>
                <td>{{$i+1}}</td>
                <td>{{$v->nip}}</td>
                <td>{{$v->nama_guru}}</td>
                <td>{{$v->alamat}}</td>
                <td>{{$v->nohp}}</td>
                <td>{{$v->email}}</td>
                <td>
                  <a href="{{url('datamaster/editguru/'.base64_encode($v->id_guru))}}"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                  <a onclick="konfirmasi('{{base64_encode($v->id_guru)}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                      window.location = '{{url("delguru")}}/'+id;

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
                <center><h3>Tambah Data Wali Kelas</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
              <form class="forms-sample" action="@if(Request::is('datamaster/editguru/*') && isset($view)) {{url('datamaster/updateguru/'.base64_encode($view->id_guru))}}  @else {{url('/tambahguru')}} @endif" method="post">{{csrf_field()}}
                  <div class="date-picker-inner">
                      <div class="form-group data-custon-pick" id="data_1">
                          <label>(*) Menunjukan Data Wajib Diisi</label>
                      </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>NIP</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                                  <input name="nip" value="@if(isset($view)){{$view->nip}}@else @endif" class="form-control" required="" type="text" placeholder="*Nip">
                              </div>
                        </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Nama</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                  <input name="nama" value="@if(isset($view)){{$view->nama_guru}}@else @endif" class="form-control" required="" type="text" placeholder="*Nama">
                              </div>
                        </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Alamat</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                  <input name="alamat" value="@if(isset($view)){{$view->alamat}}@else @endif" class="form-control" required="" type="text" placeholder="*Alamat">
                              </div>
                        </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>No HP</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                  <input name="nohp" value="@if(isset($view)){{$view->nohp}}@else @endif" class="form-control" required="" type="text" placeholder="*No HP">
                              </div>
                        </div>

                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Email</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                  <input name="email" class="form-control" value="@if(isset($view)){{$view->email}}@else @endif" required="" type="text" placeholder="*Email">
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
