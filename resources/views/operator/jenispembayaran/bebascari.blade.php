@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengaturan Tarif Bebas

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <div class="sparkline16-hd">
                <div class="main-sparkline16-hd">
                  <a href="{{url('/payment/jenis_pay')}}" style="float:right;" class="btn btn-danger">X</a>
                    <center><h4>Atur Tarif Bebas Bulanan</h4></center><hr>
                </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
                            <form class="form" action="{{url('/tambahtarifbebas')}}" method="post">{{csrf_field()}}
                              <div class="date-picker-inner">

                                <div class="form-group">
                                      <label>Jenis Pembayaran</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                          <input type="hidden" name="id" value="{{$data->id_jenispayment}}">
                                          <input type="hidden" name="idtarif" value="{{$id_tarifbebas}}">
                                          <input type="text" value="{{$data->namapayment}}"  disabled class="form-control" placeholder="*Nama Pembayaran" required>
                                      </div>
                                  </div>
                                <div class="form-group">
                                      <label>Tahun Ajaran</label>
                                      <div class="input-group date">
                                          <input type="hidden" name="idtahun" value="{{$data->id_tahun}}">
                                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                          <input type="text"  value="{{$data->tahun}}" disabled class="form-control"  required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label>Tipe Bayar</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                          <input type="text" value="{{$data->tipe}}"  disabled class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label>Pilih Kelas</label>
                                      <select name="idkelas" data-placeholder="Pilih Kelas" onchange="TampilDataTarif(this.value)" class="form-control" tabindex="-1" required>
                                          <option value="">--Pilih Kelas--</option>
                                          @foreach ($kls as $key => $kl)
                                            <option value="{{$kl->id_kelas}}" @if($kl->id_kelas==$kelas) selected @endif>{{$kl->kelas}}</option>
                                          @endforeach
                                      </select>
                                      <?php
                                      $idpay = base64_encode($data->id_jenispayment);
                                      $tahun = base64_encode($data->tahun);
                                       ?>
                                      <script>

                                          function TampilDataTarif(str) {

                                            window.location.assign("{{url('/payment/bebascari')}}/"+'{{$idpay}}/'+(str))
                                            };
                                      </script>
                                  </div>

                                  <div class="chosen-select-single mg-b-20">
                                      <label>Tarif</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                          <input type="number"class="form-control" name="tarif" value="{{$tarifbebas}}" id="fname" onkeyup="myFunction()" required>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="chosen-select-single mg-b-20">



                                          <button style="float:right;" class="btn btn-success" type="submit"> <i class="fa fa-save"></i> Simpan</button>

                                  </div>
                                </div>


                          </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      </form>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->



@endsection
