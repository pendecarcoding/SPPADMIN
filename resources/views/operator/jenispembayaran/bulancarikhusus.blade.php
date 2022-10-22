@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengaturan Tarif Bulanan Khusus

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <div class="sparkline16-hd">
                <div class="main-sparkline16-hd">
                    <center><h4>Atur Tarif Bulanan Khusus</h4></center><hr>
                </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
                            <form class="form" action="{{url('/tambahtarfibulankhusus')}}" method="post">{{csrf_field()}}
                              <div class="date-picker-inner">

                                <div class="form-group">
                                      <label>Jenis Pembayaran</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                          <input type="hidden" name="id" value="{{$data->id_jenispayment}}">
                                          <input type="hidden" name="idsekolah" value="{{Session::get('idsekolah')}}">
                                          <input type="text" value="{{$data->namapayment}}"  disabled class="form-control" placeholder="*Nama Pembayaran" required>
                                      </div>
                                  </div>
                                <div class="form-group">
                                      <label>Tahun Ajaran</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                          <input type="hidden" name="idtahun"  value="{{$data->id_tahun}}"  class="form-control"  required>
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
                                            <option value="{{base64_encode($kl->id_kelas)}}" @if($kl->id_kelas==$kelas) selected @endif>{{$kl->kelas}}</option>
                                          @endforeach
                                      </select>
                                      <?php
                                      $idpay = base64_encode($data->id_jenispayment);
                                      $tahun = base64_encode($data->tahun);
                                       ?>
                                      <script>

                                          function TampilDataTarif(str) {

                                            window.location.assign("{{url('/payment/bulanancarikhusus')}}/"+'{{$idpay}}/'+str+'/'+'{{$tahun}}')
                                            };
                                      </script>
                                  </div>

                                  <div class="form-group">
                                    <label>Pilih Kebijakan</label>
                                    <select class="form-control select2" name="keb[]" multiple="multiple" data-placeholder="Pilih Kebijakan"
                                            style="width: 100%;">
                                            <?php
                                              $id = Session::get('idsekolah');
                                              if(!empty($e->id_kebijakan)){
                                                $kbi = explode(",",$e->id_kebijakan);
                                              }
                                              else{
                                                $kbi ='';
                                              }
                                              $kb = App\KebijakanModel::where('id_sekolah',$id)
                                                      ->where('tbl_tahunajaran.status','Y')
                                                      ->join('tbl_tahunajaran','tbl_tahunajaran.id_tahun','tbl_kebijakan.id_tahun')
                                                      ->get();


                                             ?>

                                      @foreach ($kb as $index => $k)
                                      @if(!empty($e->id_kebijakan))
                                      <option value="{{$k->id_kebijakan}}"@if(in_array($k->id_kebijakan,$kbi)){{"Selected"}}@endif>{{$k->kebijakan}}</option>
                                      @else
                                      <option value="{{$k->id_kebijakan}}">{{$k->kebijakan}}</option>
                                      @endif
                                      @endforeach

                                    </select>
                                  </div>
                                  <div class="chosen-select-single mg-b-20">
                                      <label>Tarif Perbulan (Tarif Perbulan akan dikenakan sama tiap bulannya)</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                          <input type="number"class="form-control" id="fname" onkeyup="myFunction()" >
                                      </div>
                                  </div>



                                  <script>
                                    function myFunction() {
                                        var x = document.getElementById("fname");
                                        var	number_string = x.value.toString(),
                                        	sisa 	= number_string.length % 3,
                                        	rupiah 	= number_string.substr(0, sisa),
                                        	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

                                        if (ribuan) {
                                        	separator = sisa ? '.' : '';
                                        	rupiah += separator + ribuan.join('.');
                                        }
                                        var values = $("input[id='bulan']")

                                        .map(function(){return $(this).val("Rp "+rupiah);}).get();

                                        //var y = document.getElementById("bulan")[];
                                        //y.value=x.value;
                                    }
                                    </script>



                                  </div>


                          </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <div class="sparkline16-hd">
              <div class="main-sparkline16-hd">
                <a style="float:right;"class="btn btn-danger" href="{{url("/payment/paymentkhusus")}}">X</a>
                    <center><h4>Daftar Bulanan Yang Terkena Tarif</h4></center><hr>
                </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">

                                    <div class="date-picker-inner">

                                        <div class="chosen-select-single mg-b-20">
                                            <label>Nama Bulan</label>
                                              @foreach ($bln as $index =>$bl)
                                              <?php
                                              $id = Session::get('idsekolah');
                                              $tarif = App\TarifBulanKhususModel::where('id_bulan',$bl->id_bulan)->where('id_jenispayment',$data->id_jenispayment)->where('id_kelas',$kelas)->where('id_sekolahtarif',$id)->count();
                                              if($tarif > 0){
                                                $tr = App\TarifBulanKhususModel::where('id_bulan',$bl->id_bulan)->where('id_jenispayment',$data->id_jenispayment)->where('id_kelas',$kelas)->where('id_sekolahtarif',$id)->first();
                                                $idtarif  = $tr->id_tarifbulankhusus;
                                                $hrgtarif = $tr->harga_tarif;
                                              }else{
                                                $hrgtarif ='0';
                                                $idtarif  = '';
                                              }

                                               ?>
                                            <div class="input-group date">
                                                <input type="hidden" name="idtarif[]" value="{{$idtarif}}">
                                                <input style="width:200px;" type="text" value="{{$bl->bulan}}"  disabled class="form-control" placeholder="*Nama Pembayaran" required>
                                                <input type="hidden" name="idbulan[]" value="{{$bl->id_bulan}}">
                                                <input style="width:400px;" value="Rp {{number_format($hrgtarif)}}" type="text" id="bulan" name="tarifbulan[]"  class="form-control"required>
                                            </div>
                                              @endforeach
                                        </div>


                                        </div>
                                        <div class="form-group data-custon-pick" id="data_2">
                                          <br>
                                          <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                          <button type="submit" class="btn btn-success widget-btn-1 btn-sm"><i class="fa fa-save"></i>Simpan</button>
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
