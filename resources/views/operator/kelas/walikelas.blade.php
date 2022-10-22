@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Walikelas

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
                <th>Nama Wali kelas</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Kode Akses</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)

              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->nama_guru}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->kelas}}</td>
                <td>
                   {{$value->jumlah_siswa}}
                   Orang
                </td>
                <td>
                  @if($value->akses=='N')
                     <button class="btn btn-sm btn-success" onclick="generateakseswk({{$value->id}})"><i class="fa fa-key"></i> Generate</button>
                  @else
                     {{base64_decode($value->kode_akses)}}<br>
                    <button class="btn btn-sm btn-primary" onclick="resetakses({{$value->id}})"><i class="fa fa-refresh"></i> Reset</button>
                  @endif
                </td>
                <td>
                  <a onclick="konfirmasi({{$value->id}})" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>

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
                      window.location = '{{url("deletewalikelas")}}/'+id;

                    }



                    );

                    }
                    function generateakseswk(id){

                    swal({   title: "Buat Akun Akses Kesehatan untuk Guru ini?",
                    text: "Akses Kesehatan digunakan untuk Walikelas mengupdate data kesehatan Siswa",   type: "warning",
                    showCancelButton: true,   confirmButtonColor: "#00a65a",
                    confirmButtonText: "Ya, Berikan Akses dikelas ini!",   closeOnConfirm: false
                    },
                    function(){   swal("akses diberikan!", "", "success")
                        window.location = '{{url("generateakseswk")}}/'+id;

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
                <center><h3>Tambah Data Wali Kelas</h3></center>
                <hr>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="sparkline16-graph">
              <form class="forms-sample" action="{{url('/tambahwalikelas')}}" method="post">{{csrf_field()}}
                  <div class="date-picker-inner">
                      <div class="form-group data-custon-pick" id="data_1">
                          <label>(*) Menunjukan Data Wajib Diisi</label>
                      </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Nama Wali Kelas</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                <select class="form-control" name="id_guru" required>
                                  <option value="">--Pilih Guru--</option>
                                  @foreach($guru as $i => $vg)
                                  <option value="{{$vg->id_guru}}">{{$vg->nama_guru.' ('.$vg->nip.')'}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Kelas</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                  <select class="form-control" name="id_kelas" required>
                                    <option value="">--Pilih Kelas--</option>
                                    @foreach($kelas as $i => $vks)
                                    <option value="{{$vks->id_kelas}}">{{$vks->kelas}}</option>
                                    @endforeach
                                  </select>
                              </div>
                        </div>

                        <div class="form-group data-custon-pick" id="data_2">
                            <label>Tahun</label>
                              <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                  <select class="form-control" name="id_tahun" required>
                                    <option value="">--Pilih Tahun--</option>
                                    @foreach($tahun as $i => $vt)
                                    <option value="{{$vt->id_tahun}}">{{$vt->tahun}}</option>
                                    @endforeach
                                  </select>
                              </div>
                        </div>

                          <div class="form-group data-custon-pick" id="data_2">
                                <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <button class="btn btn-warning widget-btn-1 btn-sm" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                    <button class="btn btn-success widget-btn-1 btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
                                </div>
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
