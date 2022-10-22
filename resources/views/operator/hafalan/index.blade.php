@extends('layouts.admin_design')
@section('content')



<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Form Data Hafalan Siswa</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('addinfohafalan') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id_kelas" value="{{ $wk->id_kelas }}">
                                    <label>Nama Siswa</label>
                                    <select name="nama" required class="form-control">
                                        <option value="">--Pilih Siswa--</option>
                                        @foreach($siswa as $i => $v)
                                            <option value="{{ $v->id_siswa }}">
                                                {{ '('.$v->nis.') '.$v->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Setor</label>
                                    <input type="date" class="form-control" name="tgl" required>
                                </div>
                                <div class="form-group">
                                    <label>Batas Hafalan</label>
                                    <textarea name="batas" class="form-control" style="height: 200px;"
                                        required></textarea>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> simpan</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <a data-toggle="modal" data-target="#myModal" class="btn btn-primary right" style="float:right"><i
                            class="fa fa-plus"></i> Tambah Data
                        Hafalan</a>

                    <h4>Data Hafalan Siswa</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable no-footer"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="No: activate to sort column descending"
                                                style="width: 35.975px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="NIP: activate to sort column ascending"
                                                style="width: 58.15px;">NIS</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Nama: activate to sort column ascending"
                                                style="width: 61.3625px;">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Alamat: activate to sort column ascending"
                                                style="width: 71.825px;">Kelas</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="No Hp: activate to sort column ascending"
                                                style="width: 95.35px;">Hafalan Siswa</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="No Hp: activate to sort column ascending"
                                                style="width: 95.35px;">Tgl Check</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Aksi: activate to sort column ascending"
                                                style="width: 74.6625px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($data as $i =>$v)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i+1 }}</td>
                                                <td>{{ $v->nis }}</td>
                                                <td>{{ $v->nama }}</td>
                                                <td>{{ $v->kelas }}</td>
                                                <td>{{ $v->batas_hafalan }}</td>
                                                <td>{{ $v->tgl_setor }}</td>

                                                <td>
                                                    <a data-toggle="modal" data-target="#edit{{ $v->id }}" href="#"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
                                                    </a>

                                                    <a  onclick="konfirmasi({{$v->id}})" href="#" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i>
                                                    </a>


                                                </td>
                                            </tr>

                                            <div id="edit{{ $v->id }}" class="modal fade" role="dialog">
                                             <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Form Update Data Hafalan Siswa</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('updateinfohafalan') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                    <input type="hidden" name="id_kelas" value="{{ $wk->id_kelas }}">
                                    <label>Nama Siswa</label><br>
                                    <select name="nama" required class="form-control" style="width:500px">
                                        <option value="">--Pilih Siswa--</option>
                                        @foreach($siswa as $i => $vs)
                                            <option value="{{ $vs->id_siswa }}" @if($vs->id_siswa==$v->id_siswa) selected @endif>
                                                {{ '('.$vs->nis.') '.$vs->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div><br>
                                <div class="form-group">
                                    <label>Tgl Setor</label><br>
                                    <input type="date" value="{{ $v->tgl_setor }}" class="form-control" name="tgl" style="width:500px" required>
                                </div><br>
                                <div class="form-group">
                                    <label>Batas Hafalan</label>
                                    <textarea name="batas" class="form-control" style="height: 200px;width:500px;"
                                        required>{{ $v->batas_hafalan }}</textarea>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> simpan</button>
                        </div>
                        </form>
                    </div>

                </div>
                                            </div>


                                            <script>
                  function konfirmasi(id){

                  swal({   title: "Anda yakin hapus data ini?",
                  text: "Data yang terhapus tidak dapat di kembalikan !!!",   type: "warning",
                  showCancelButton: true,   confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya, hapus data!",   closeOnConfirm: false
                  },
                  function(){   swal("data dihapus!", "", "success")
                      window.location = '{{url("delhafalan")}}/'+id;

                    }



                    );

                    }

                  </script>

                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
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

@endsection
