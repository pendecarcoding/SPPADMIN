@extends('layouts.admin_design')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaturan Admin
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
            <form role="form" method="post" action="{{url('/updateadmin')}}" enctype="multipart/form-data">{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{$data->namauser}}" id="exampleInputEmail1" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nohp</label>
                  <input type="hidden" name='id' value="{{$data->id_user}}">
                  <input type="text" class="form-control" name="nohp" value="{{$data->nohp}}" id="exampleInputEmail1" placeholder="Nohp">
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
                  <input type="color" style="height:100px;width:100px;" class="form-control" name="warna" value="{{$data->colour}}" id="exampleInputEmail1" placeholder="Nohp">
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
            <form class="form-horizontal" method="post" action="{{url('/updateprivasi')}}" >{{csrf_field()}}
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
                    <input type="hidden" name='id' value="{{$data->id_user}}">
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
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-building"></i> Data Instansi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{url('/updateinstansi')}}" enctype="multipart/form-data" >{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode Instansi</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->kode_instansi}}" name="kodeinstansi" class="form-control" id="inputEmail3" placeholder="kodeinstansi">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Riwayat SPT</label>

                  <div class="col-sm-10">
                    <input type="number" value="{{$data->countspt}}" name="riwayatspt" class="form-control" id="inputEmail3" placeholder="Riwayat SPT" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kepala Dinas (PLT/PLH)</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="nip">
                     @foreach($pg as $index => $pegawai)
                      <option value="{{$pegawai->id_pegawai}}" @if($data->id_pegawai==$pegawai->id_pegawai) selected @endif>{{$pegawai->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pemerintahan</label>

                  <div class="col-sm-10">
                    <input type="username" value="{{$data->pemerintahan}}" name="pemerintahan" class="form-control" id="inputEmail3" placeholder="Pemerintahan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Instansi</label>

                  <div class="col-sm-10">
                    <input type="hidden" name='id' value="{{$data->id_instansi}}">
                    <input type="text" value="{{$data->instansi}}" name="instansi" class="form-control" id="inputPassword3" placeholder="Instansi" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat & Kode Pos</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->alamat}}" name="alamat" class="form-control" id="inputPassword3" placeholder="Alamat & Kode Pos" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email Instansi</label>

                  <div class="col-sm-10">
                    <input type="email" name="email" value="{{$data->email}}" class="form-control" id="inputPassword3" placeholder="Email" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Logo Instansi</label>

                  <div class="col-sm-10">
                    <img id="prev" class="imgprofile"  style="width:100px;height:120px;" src="{{asset("images/logo/$data->logo")}}">
                    <input type="hidden" name="file" value="{{$data->logo}}">
                    <!--<script logo instansi-->
                    <script>
                    function tampilkanPreviewlogo(gambar,idpreview){
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
                                  document.getElementById("logo").value = "";
                                }
                          }
                    }
                    </script>


                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*"  onchange="tampilkanPreviewlogo(this,'prev')" id="inputPassword3">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-refresh"></i> Update Instansi</button>
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
