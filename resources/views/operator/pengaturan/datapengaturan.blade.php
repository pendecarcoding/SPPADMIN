@extends('layouts.admin_design')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaturan Operator
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
              <h3 class="box-title"><i class="fa fa-user"></i> Data diri</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('/updateoperator')}}" enctype="multipart/form-data">{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{$data->nama}}" id="exampleInputEmail1" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nohp</label>
                  <input type="hidden" name='id' value="{{$data->id_admin}}">
                  <input type="text" class="form-control" name="nohp" value="{{$data->nohpuser}}" id="exampleInputEmail1" placeholder="Nohp">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Foto</label><br>
                  <input type="hidden" name="file" value="{{$data->foto}}">
                  <img  id="preview" class="imgprofile" src="{{asset("images/$data->foto")}}" style="width:100px;height:100px;" alt="">
                  <br>
                  <br><input  name="foto" type="file" id="file"  onchange="tampilkanPreview(this,'preview')">
				              <script>
                      function tampilkanPreview(gambar,idpreview){
                        //membuat objek gambar
                          var gb = gambar.files;
                        //loop untuk merender gambar
                            for (var i = 0; i < gb.length; i++){
                              //bikin variabel
                                var gbPreview = gb[i];
                                var imageType = /image.*/;
                                var preview=document.getElementById(idpreview);
                                var reader = new FileReader();
                                  if (gbPreview.type.match(imageType)) {
                                  //jika tipe data sesuai
                                    preview.file = gbPreview;
                                    reader.onload = (function(element) {
                                      return function(e) {
                                          element.src = e.target.result;
                                      };
                                    })(preview);
                                    //membaca data URL gambar
                                    reader.readAsDataURL(gbPreview);
                                  }
                                  else{
                                  //jika tipe data tidak sesuai
                                    alert("Type file tidak sesuai. Khusus image.");
                                    document.getElementById("file").value = "";
                                  }
                            }
                      }
                      </script>

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Warna Template</label>
                  <input type="color" style="height:50px;width:200px;" class="form-control" name="warna" value="{{$data->colour}}" id="exampleInputEmail1" placeholder="Nohp">
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>


        <!--/.col (left) -->
        <!-- right column -->

        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-key"></i> Data Privasi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{url('/updateprivasiope')}}" >{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="username" value="{{$data->username}}" name="username" class="form-control" id="inputEmail3" placeholder="username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="hidden" name='id' value="{{$data->id_admin}}">
                    <input type="password" name="pass1" class="form-control" id="inputPassword3" placeholder="Password" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ulangi Password</label>

                  <div class="col-sm-10">
                    <input type="password" name="pass2" class="form-control" id="inputPassword3" placeholder="Ulangipassword" required>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <button type="submit" class="btn btn-info pull-right"> <i class="fa fa-refresh"></i> Update Privasi</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

        </div>
      



        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->



@endsection
