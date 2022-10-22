@extends('layouts.admin_design')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaturan Sekolah
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->

        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-building"></i> Data Sekolah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{url('/updatedatasekolah')}}" >{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <?php
                    $idsekolah = Session::get('idsekolah');
                    $ds        = App\InstansiModel::where('id_sekolah',$idsekolah)->first();
                   ?>
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Sekolah</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->nm_sekolah}}" name="nmsekolah" class="form-control" id="inputEmail3" placeholder="Nama Sekolah">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-10">
                    <input type="hidden" name='id' value="{{$ds->id_sekolah}}">
                    <input type="text" value="{{$ds->al_sekolah}}"name="alsekolah" class="form-control" id="inputPassword3" placeholder="Alamat Sekolah" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kecamatan</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->kecamatan}}" name="kec" class="form-control" id="inputPassword3" placeholder="Kecamatan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kabupaten</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->kabupaten}}" name="kab" class="form-control" id="inputPassword3" placeholder="Kabupaten" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Kepala Sekolah</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->nm_kepsek}}" name="kepsek" class="form-control" id="inputPassword3" placeholder="Nama Kepala Sekolah" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">NIP Kepala Sekolah</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->nipkepsek}}" name="nipkepsek" class="form-control" id="inputPassword3" placeholder="NIP Kepala Sekolah" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Bendahara Sekolah</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->bendahara}}" name="bend" class="form-control" id="inputPassword3" placeholder="Nama Bendahara" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">NIP Bendahara</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->nipbendahara}}" name="nipbend" class="form-control" id="inputPassword3" placeholder="NIP Bendahara" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Website</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->website}}" name="website" class="form-control" id="inputPassword3" placeholder="Website" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Email</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->email}}" name="email" class="form-control" id="inputPassword3" placeholder="email" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Telp Sekolah</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$ds->nohp}}" name="nohp" class="form-control" id="inputPassword3" placeholder="Telp Sekolah" required>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <button type="submit" class="btn btn-info pull-right"> <i class="fa fa-refresh"></i> Update Sekolah</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <div class="box box-primary">
            <div class="box-body">
            <div class="sparkline16-list responsive-mg-b-30">
                      <div class="sparkline16-hd">
                          <div class="main-sparkline16-hd">

                          </div>
                      </div>
                      <div class="sparkline16-graph">
                        <form class="forms-sample" action="{{url('/uploadlogo')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
                          <div class="date-picker-inner">

                              <div class="form-group data-custon-pick" id="data_2">
                                  <center>
                                    <img  id="preview" style="width:300px;heigth:300px;" src="{{asset("images/logo/$ds->logo")}}">

                                  </center>
                                    <div class="input-group date">

                                      <span class="input-group-addon"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                      <input type="hidden" value="{{$ds->id_sekolah}}" name="id">
                                      <input type="hidden" value="{{$ds->logo}}" name="nmlogo">
                                      <input type="file" name="logo" id="file" class="form-control"  onchange="tampilkanPreview(this,'preview')" placeholder="*Nama Sekolah" required="">
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
                              </div>


                              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                <button type="submit" class="btn btn-success widget-btn-1 btn-sm"><i class="fa fa-upload"></i> Upload</button>
                              </div>
                          </div>
                        </form>
                      </div>
                  </div>
          </div>
          </div>
        </div>



        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->



@endsection
