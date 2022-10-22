@extends('layouts.admin_design')
@section('content')


        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>


        @if(Session::get('level')=='operator')
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h4>{{$cnsis}}</h4>

                  <p>Siswa Aktif</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="{{url('/datamaster/datasiswa')}}" class="small-box-footer">Lihat<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4>Rp {{number_format($cnpeto)}}</h4>

                  <p>Pendapatan Hari ini</p>
                </div>
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4>Rp {{number_format($cnketo)}}</h4>

                  <p>Pengeluaran Hari ini</p>
                </div>
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h4>Rp {{number_format($saldo)}}</h4>

                  <p>Saldo</p>
                </div>
                <div class="icon">
                  <i class="fa fa-credit-card"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
          <div class="col-lg-12 col-xs-12">

          <div class="box box-primary slimscroll">
             <div class="box-body">

                  <div class="col-lg-6 col-xs-6">
                    <center><h3>Grafik Pemasukan (<?php echo date('Y'); ?>)</h3></center>
                     <div id="chartdiv"></div>
                   </div>
                   <div class="col-lg-6 col-xs-6">
                     <center><h3>Grafik Pengeluaran  (<?php echo date('Y'); ?>)</h3></center>
                     <div style="height:400px;" id="chartpengeluaran"></div>
                   </div>



             </div>
          </div>

          </div>

        </div>
          <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
        @endif





@endsection
