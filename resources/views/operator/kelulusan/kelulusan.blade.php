@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">


  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-4">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-list responsive-mg-b-30">
                          <div class="sparkline16-hd">
                              <div class="main-sparkline16-hd">

                              </div>
                          </div>
                          <div class="sparkline16-graph">
                            <form class="forms-sample" action="{{url('/kelulusan/lihatsiswakelas/')}}" method="post">{{csrf_field()}}
                              <div class="date-picker-inner">

                                  <div class="form-group data-custon-pick" id="data_2">

                                    <div class="chosen-select-single mg-b-20">
                                        <label>Pilih Kelas</label>
                                        <select name="idkelas" data-placeholder="Pilih Kelas" class="form-control" tabindex="-1" required>
                                            <option value="">--Pilih Kelas--</option>
                                          @foreach ($kls as $key => $ks)
                                            <option value="{{$ks->id_kelas}}">{{$ks->kelas}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">



                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <button type="reset" class="btn btn-warning widget-btn-1 btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button type="submit" class="btn btn-success widget-btn-1 btn-sm"><i class="fa fa-eye"></i> Tampilkan</button>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-xs-8">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <div class="main-sparkline16-hd">
                <center><h4>Tambah Data Kelas</h4></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-list responsive-mg-b-30">
                                          <div class="sparkline16-hd">
                                              <div class="main-sparkline16-hd">

                                                  <h4>Daftar Siswa Kelas</h4>

                                              </div>
                                          </div>
                                          <div class="sparkline16-graph">

                                              <div class="date-picker-inner">

                                                  <div class="chosen-select-single mg-b-20">
                                                      <label>Nama Siswa</label>

                                                  </div>


                                                  </div>
                                                  <div class="form-group data-custon-pick" id="data_2">

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
