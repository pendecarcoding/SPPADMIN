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
                                            <option value="{{$ks->id_kelas}}"@if($ks->id_kelas==$dkelas->id_kelas){{{'selected'}}} @else{{''}}@endif>{{$ks->kelas}}</option>
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
                            </form>
                          </div>
                        </div>
                      </div>
          </div>
          <!-- /.box-header -->


          <!-- /.box-body -->
        </div>
        <!-- /.box -->

  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
    <div class="box">
     <div class="box-body">
        <form class="forms-sample" action="{{url('/aksilulus')}}" method="post">{{csrf_field()}}
                                  <div class="sparkline16-list responsive-mg-b-30">
                                      <div class="sparkline16-hd">
                                          <div class="main-sparkline16-hd">
                                              <a style="float:right;"class="btn btn-danger" href="{{url('/kenaikan/setkenaikan')}}">X</a>
                                              <h4>Daftar Kelas Siswa</h4>


                                          </div>
                                      </div>
                                      <div class="sparkline16-graph">

                                          <div class="date-picker-inner">

                                              <div class="chosen-select-single mg-b-20">
                                                  <label>Nama Siswa</label>
                                                  @foreach ($data as $index =>$d)
                                                <div class="input-group date">



                                                  <table>
                                                    <th>
                                                      <input type="text" style="width:100px;" disabled class="form-control" name="idsiswa[]" value="NIS :{{$d->nis}}">
                                                    </th>
                                                    <th>
                                                    <th><input style="width:200px;" type="text" value="{{$d->nama}}"  disabled class="form-control" placeholder="*Nama Pembayaran" required>

                                                    </th>
                                                    <th>
                                                      <input style="width:300px;" type="text" id="bulan" value="{{$d->kelas}}" disabled class="form-control"required>
                                                    </th>
                                                    <th>
                                                      <label style="margin-top:1px;"  class="container">
                                                      <input  type="checkbox" name="idsiswa[]" value="{{$d->nis}}" class="form-control" checked="checked">
                                                        <span class="checkmark"></span>
                                                      </label>
                                                    </th>
                                                  </table>
                                                  </div>





                                                  @endforeach

                                              </div>

                                              <div class="form-group data-custon-pick" id="data_2">

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Tahun Kelulusan</label>
                                                    <select name="idtahun" data-placeholder="Pilih Tahun" class="form-control" tabindex="-1" required>
                                                        <option value="">--Pilih Tahun Lulus--</option>
                                                      @foreach ($tahun as $key => $th)
                                                        <option value="{{$th->id_tahun}}">{{$th->tahun}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                              </div>
                                              <div class="form-group data-custon-pick data-custom-mg" id="data_5">

                                                <button type="submit" class="btn btn-success widget-btn-1 btn-sm"><i class="fa fa-proses"></i> Proses Lulus</button>
                                              </div>


                                              </div>
                                              <div class="form-group data-custon-pick" id="data_2">

                                          </div>
                                        </form>
        </div>
                                  </div>
                              </div>


        </div>
      </div>
      <!-- /.col -->
    </div>
  </div>
    </div>
  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->



@endsection
