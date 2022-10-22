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

            <form class="forms-sample" action="{{url('/pembayaran/hasilcaripembayaran')}}" method="get"><input name="_token" type="hidden" value="72jrTytq4J9xmEiqfhGymYjXRRto1i4bOKIbxmlp">
                                          <div class="date-picker-inner">

                                            <div class="form-group data-custon-pick" id="data_2">
                                                  </div><table>
                                              <tbody><tr><th>

                                              <div class="form-group data-custon-pick" id="data_2">

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>Tahun Ajaran</label>
                                                    <select name="idtahun" tabindex="-1" class="form-control" style="width: 200px;" required="" data-placeholder="Pilih Kelas">
                                                         <option value="">--Pilih Tahun Ajaran--</option>
                                                         @foreach($th as $index => $t)
                                                         <option value="{{$t->id_tahun}}">{{$t->tahun}}</option>
                                                         @endforeach
                                                   </select>
                                                </div>
                                              </div>
                                              </th>

                                              <th>

                                              <div class="form-group data-custon-pick" id="data_2">

                                                <div class="chosen-select-single mg-b-20">
                                                    <label>NIS Siswa</label>
                                                    <input name="nis" class="form-control" type="text">
                                                </div>
                                              </div>
                                              </th>

                                              <th>

                                              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                                <div class="chosen-select-single mg-b-20" style="margin-top:20px;">
                                                <button class="btn btn-warning widget-btn-1 btn-sm" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                                <button class="btn btn-success widget-btn-1 btn-sm" type="submit"><i class="fa fa-eye"></i> Tampilkan</button>
                                              </div>
                                              </div>

                                              </th>

                                                </tr></tbody></table>
                                        </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">


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
