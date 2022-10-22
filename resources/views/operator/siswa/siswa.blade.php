@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Siswa

    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-8">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <a data-toggle="modal" data-target="#Excelimport" class="btn btn-success"><i class="fa fa-file-excel-o"> Import data Excel</i></a>

          </div>
          <!-- /.box-header -->
          <div id="Excelimport" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
              <div class="modal-dialog">
                  <div class="modal-content">



                      <div class="modal-body">
                      <form  method="post" action="{{url('/importsiswa')}}" enctype="multipart/form-data">@csrf
                        <h4>Perhatian !!!</h4><hr><br>
                        Untuk menginport data excel pastikan data tidak duplikat dan sesuai dengan format excel yang telah ditetapkan
                        <br><a href="{{url('/format/datasiswa.xlsx')}}" class="btn btn-primary"><i class="fa fa-download"></i> Download format</a>
                        <br><br>
                        <input type="file" name="import_file" class="form-control">



                      </div>

                      <div class="modal-footer">
                          <button type="reset" class="btn btn-danger" data-dismiss="modal" href="#"> Batal</Button>
                          <button class="btn btn-success" type="submit" href="#"><i class="fa fa-save"></i> Simpan</Button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nama Ibu</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)

              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->nis}}</td>
                <td>{{$value->nama}}</td>
                <td>{{$value->kelas}}</td>
                <td>
                {{$value->nama_ibu}}
                </td>
                <td>
                  <?php
                  $idpos = base64_encode($value->nis);
                   ?>
                  <a href="{{url("/datamaster/datasiswa/edit/$idpos")}}" class="btn btn-warning"> <i class="fa fa-pencil"></i></a>
                  <button class="btn btn-danger" onclick="konfirmasi({{$value->nis}})"><i class="fa fa-trash"></i></button>
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
                      window.location = '{{url("delsis")}}/'+id;

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
            <div class="main-sparkline16-hd">
                <center><h3>Tambah Data Siswa</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
                            <form class="forms-sample" action="{{url('/tambahsiswa')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
                              <div class="date-picker-inner">
                                  <div class="form-group data-custon-pick" id="data_1">
                                      <label>(*) Menunjukan Data Wajib Diisi</label>

                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>NIS</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                          <input type="text" name="nis" class="form-control" placeholder="*NIS" required>
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Nama Lengkap</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                          <input type="text" name="nama" class="form-control" placeholder="*Nama Lengkap" required>
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Tempat Lahir </label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                          <input type="text" name="tempatlahir" class="form-control" placeholder="*Tempat Lahir" required>
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Tanggal Lahir</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-calender" aria-hidden="true"></i></span>
                                          <input type="date" name="tl" class="form-control" placeholder="*Tanggal Lahir" required>
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Nama Ibu Kandung</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                          <input type="text" name="namaibu" class="form-control" placeholder="*Nama Ibu" required>
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">

                                    <div class="chosen-select-single mg-b-20">
                                        <label>Pilih Kelas</label>
                                        <select name="idkelas" data-placeholder="Pilih Kelas" class="form-control" tabindex="-1" required>
                                            <option value="">--Pilih Kelas--</option>
                                          @foreach ($kls as $key => $ks)
                                            <option value="{{$ks->id_kelas}}">{{$ks->kelas}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">

                                    <div class="chosen-select-single mg-b-20">
                                        <label>Tahun Penerapan</label>
                                        <select name="idtahun" data-placeholder="Pilih Kelas" class="form-control" tabindex="-1" required>
                                            <option value="">--Pilih Tahun Penerapan--</option>
                                          @foreach ($tahun as $key => $th)
                                            <option value="{{$th->id_tahun}}">{{$th->tahun}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">
                                      <label>Alamat</label>
                                      <div class="input-group date">
                                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                          <input type="text" name="alamat" class="form-control" placeholder="*Alamat" required>
                                      </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">

                                    <div class="chosen-select-single mg-b-20">
                                        <label>Pilih Foto Siswa (3X4)</label><br>
                                        <img  id="preview" class="imgprofile" src="" style="width:200px;height:200px;" alt="">
                  <br><input class="form-control" name="gambar" id="file" type="file" accept="image/*"  onchange="tampilkanPreview(this,'preview')">
				              <script>
            function tampilkanPreview(gambar,idpreview){
//                membuat objek gambar
                var gb = gambar.files;

//                loop untuk merender gambar
                for (var i = 0; i < gb.length; i++){
//                    bikin variabel
                    var gbPreview = gb[i];
                    var imageType = /image.*/;
                    var preview=document.getElementById(idpreview);
                    var reader = new FileReader();

                    if (gbPreview.type.match(imageType)) {
//                        jika tipe data sesuai
                        preview.file = gbPreview;
                        reader.onload = (function(element) {
                            return function(e) {
                                element.src = e.target.result;
                            };
                        })(preview);

    //                    membaca data URL gambar
                        reader.readAsDataURL(gbPreview);
                    }else{
//                        jika tipe data tidak sesuai
                        alert("Type file tidak sesuai. Khusus image.");
                          document.getElementById("file").value = "";
                    }

                }
            }
      </script>

                                    </div>
                                  </div>
                                  <div class="form-group data-custon-pick" id="data_2">



                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <button type="reset" class="btn btn-warning widget-btn-1 btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button type="submit" class="btn btn-success widget-btn-1 btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
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
