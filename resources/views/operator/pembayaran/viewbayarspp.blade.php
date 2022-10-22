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
<div class="box">
      <div class="container-fluid">
        <div class="box-body">
    <div class="row">

            <!--form input-->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                      <div class="sparkline16-list responsive-mg-b-30">
                          <div class="sparkline16-hd">
                              <div class="main-sparkline16-hd">
                                  <h1>Pembayaran Siswa</h1>
                              </div>
                          </div>
                          <div class="sparkline16-graph">

                              <div class="date-picker-inner">

                                  <div class="chosen-select-single mg-b-20">
                                      <label>Jenis Pembayaran</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                          <input type="text" value="{{$jp->namapayment}}"  disabled class="form-control" placeholder="*Nama Pembayaran" required>
                                      </div>
                                  </div>
                                  <div class="chosen-select-single mg-b-20">
                                      <label>Tahun Ajaran</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                          <input type="text"  value="{{$th->tahun}}" disabled class="form-control"  required>
                                      </div>
                                  </div>
                                  <div class="chosen-select-single mg-b-20">
                                      <label>NIS</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                          <input type="text" value="{{$ds->nis}}"  disabled class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="chosen-select-single mg-b-20">
                                      <label>Nama Siswa</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>

                                          <input type="text" value="{{$ds->nama}}"  disabled class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="chosen-select-single mg-b-20">
                                      <label>Kelas</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>

                                          <input type="text" value="{{$ds->kelas}}"  disabled class="form-control" required>
                                      </div>
                                  </div>






                                  </div>


                          </div>
                      </div>
                  </div>

                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="sparkline16-list responsive-mg-b-30">
                                <div class="sparkline16-hd">
                                    <div class="main-sparkline16-hd">
                                      <form class="forms-sample" action="{{url('/pembayaran/hasilcaripembayaran')}}" method="post">{{csrf_field()}}
                                        <input type="hidden" value="{{$ds->nis}}" name="nis">
                                        <input type="hidden" value="{{$th->id_tahun}}" name="idtahun">
                                      <button type="submit" style="float:right;"class="btn btn-danger" href="">X</button>
                                    </form>
                                        <h1>Pembayaran Tagihan Bulanan</h1><a class="btn btn-warning" href="{{url("/pdf/cetakbayarbulanan/$jp->id_jenispayment/$ds->nis/$th->id_tahun")}}"><i class="fa fa-print"></i> Cetak Keseluruhan</a>
                                        <div class="date-picker-inner">

                                          <table id="customers">
      <tr>
        <th>No</th>
        <th>Nama Bulan</th>
        <th>Tagihan</th>
        <th>Status</th>

      </tr>

      @foreach ($jb as $index =>$j)
      <tr>
        <td>{{$index+1}}</td>
        <td>{{$j->bulan}}</td>
        <td>Rp {{number_format($j->harga_tarif)}}</td>
        <td>
          <?php
          $id = App\BayarBulananModel::where('id_tarifbulan',$j->id_tarifbulan)
                ->where('nis',$ds->nis)->count();

          if($id > 0){
            echo 'Lunas';
          }
          else{

            
            ?>
            <a href="#" onclick="konfirmasi({{$j->id_tarifbulan}},{{$ds->nis}},{{$j->harga_tarif}},{{$jp->id_jenispayment}},{{$th->id_tahun}})" class="btn btn-success"><i class="fa fa-money"></i> Bayar</a>
            <script>
            function konfirmasi(id,nis,harga,idp,th){

            swal({   title: "Anda yakin Ingin Melakukan Pembayaran?",
            text: "Pastikan terlebih dahulu Pembayaran Sudah DiTerima",   type: "warning",
            showCancelButton: true,   confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Sudah Dibayar!",   closeOnConfirm: false
            },
            function(){   swal("Pembayaran Berhasil!", "", "success")
            window.location = '{{url("bayarbulanan")}}/'+id+'/'+nis+'/'+harga+'/'+idp+'/'+th;

            }



            );

            }

            </script>

            <?php

          }

          ?>


        </td>



      </tr>
      @endforeach


    </table>

                                      </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                      </div>
    </div>
  </div>
    <!-- /.row -->
  </div>
  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->



@endsection
