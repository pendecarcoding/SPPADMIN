@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Tarif Khusus

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
                <th>Jenis Pembayaran</th>
                <th>Tipe</th>
                <th>Tahun</th>
                <th>SET</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                <?php
                $idpay = base64_encode($value->id_jenispayment);
                 ?>
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->pos}}</td>
                <td>{{$value->namapayment}}</td>
                <td>{{$value->tipe}}</td>
                <td>{{$value->tahun}}</td>
                <td>
                   @if($value->tipe=='Bulanan')
                  <a href="{{url("/payment/bulanankhusus/$idpay")}}" class="btn btn-danger"><i class="fa fa-cog"></i></a></td>
                  @endif
                  @if($value->tipe=='Bebas')
                  <a href="{{url("/payment/bebaskhusus/$idpay")}}" class="btn btn-warning"><i class="fa fa-cog"></i></a></td>
                 @endif
                <td>


                  <a href="{{url("/payment/jenis_paykhusus/edit/$idpay")}}" class="btn btn-warning"> <i class="fa fa-pencil"></i> Edit</a>
                  <button class="btn btn-danger" onclick="konfirmasi({{$value->id_jenispayment}})"><i class="fa fa-trash"></i> Hapus</button>
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
                      window.location = '{{url("deletepaykhusus")}}/'+id;

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
            <div class="sparkline16-hd">
                <div class="main-sparkline16-hd">
                  <a href="{{url('/payment/paymentkhusus')}}" style="float:right;" class="btn btn-danger">x</a>
                    <center><h3>Edit Tarif Khusus</h3></center>
                    <hr>
                </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-list responsive-mg-b-30">

                          <div class="sparkline16-graph">
                            <form class="form" action="{{url('/updatepaymentkhusus')}}" method="post">{{csrf_field()}}
                              <div class="date-picker-inner">
                                <input type="hidden" name="id" value="{{$e->id_jenispayment}}">
                                  <div class="form-group data-custon-pick" id="data_1">
                                      <label>(*) Menunjukan Data Wajib Diisi</label>

                                  </div>
                                  <div class="form-group">
                                      <label>Pilih POS</label>
                                      <select style="background-color:#3e3e3e;color:white;" name="idpos" tabindex="-1" class="form-control" required>
                                          <option value="">--Pilih POS--</option>
                                            @foreach($pos as $index => $p)
                                            <option value="{{$p->id_pos}}" @if($p->id_pos==$e->id_pos) selected @endif>{{$p->pos}}</option>
                                            @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label>Pilih Tahun Ajaran</label>
                                      <select style="background-color:#3e3e3e;color:white;" name="idtahun" tabindex="-1" class="form-control" required="" data-placeholder="Pilih Kelas">
                                          <option value="">--Pilih Tahun--</option>
                                          @foreach($th as $index=>$t)
                                            <option value="{{$t->id_tahun}}" @if($t->id_tahun==$e->id_tahun) selected @endif>{{$t->tahun}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label>Nama Pembayaran</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                          <input style="background-color:#3e3e3e;color:white;" name="nama" value="{{$e->namapayment}}" class="form-control" required="" type="text" placeholder="*Nama Pembayaran">
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Tipe</label>

                                        <div class="switch-field">
                                          <input name="tipe" id="switch_left" type="radio" @if($e->tipe=='Bulanan') checked @endif value="Bulanan">
                                          <label style="width: 100px;" for="switch_left">Bulanan</label>
                                          <input name="tipe" id="switch_right" type="radio" @if($e->tipe=='Bebas') checked @endif value="Bebas">
                                          <label style="width: 100px;" for="switch_right">Bebas</label>
                                        </div>

                                  </div>

                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">



                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <button class="btn btn-warning widget-btn-1 btn-sm" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button class="btn btn-success widget-btn-1 btn-sm" type="submit"><i class="fa fa-save"></i> Update Data</button>
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
