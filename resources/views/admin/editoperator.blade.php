@extends('layouts.admin_design')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Data Operator

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form Edit Data Operator</h3>
            </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('/updateop')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
            <div class="box-body">

              <div class="form-group">
                <label for="exampleInputPassword1">Nama</label>
                <input type="hidden" name="id" value="{{$d->id_user}}">
                <input type="text" name="nama" value="{{$d->namauser}}" class="form-control"  placeholder="Nama Operator" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">No Hp</label>
                <input type="text" name="nohp" value="{{$d->nohp}}" class="form-control"  placeholder="No Hp" required>
              </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (left) -->
      <!--updateprivasi-->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form Edit Data Privasi</h3>
            <a href="{{url('master/dataoperator')}}" style="float:right;"class="btn btn-danger">x</a>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{url('/updateoppriv')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
            <div class="box-body">

              <div class="form-group">
                <label for="exampleInputPassword1">Username</label>
                <input type="hidden" name="id" value="{{$d->id_user}}">
                <input type="text" name="uname" value="{{$d->username}}" class="form-control"  placeholder="Nama Operator" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="pass1" class="form-control"  placeholder="Password" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Ulangi Password</label>
                <input type="password" name="pass2" class="form-control"  placeholder="Ulangi Password" required>
              </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.box -->

      </div>
      <!--/update-->

    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->




@endsection
