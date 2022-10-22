@extends('layouts.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Walimurid

    </h1>

</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah data Wali Murid</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('addwalimurid') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Wali Murid</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" name="nohp">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" style="width:100%;height:50px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Siswa</label>
                        <select style="width:100%" name="id_siswa[]" multiple class="form-control select2" required>

                            <option value="">--Pilih Siswa--</option>
                            @foreach($siswa as $i => $vs)
                                <option value="{{ $vs->id_siswa }}">{{ $vs->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>

    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                    <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm" style="float:right"><i
                            class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Wali Murid</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Anak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->nohp }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->alamat }}</td>
                                    <td>
                                        @foreach($siswa as $i => $vs)
                                                                @if(in_array($vs->id_siswa,explode(',',$value->id_siswa))) <a class="btn btn-sm btn-primary"> {{ $vs->nama}} </a>  @endif

                                                            @endforeach

                                    </td>

                                    <td>

                                        <a data-toggle="modal" data-target="#e{{ $value->id }}"
                                            class="btn btn-sm btn-warning"> <i class="fa fa-edit"></i></a>
                                        <a onclick="konfirmasi({{ $value->id }})" class="btn btn-sm btn-danger"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <script>
                                    function konfirmasi(id) {

                                        swal({
                                                title: "Anda yakin hapus data ini?",
                                                text: "Data yang terhapus tidak dapat di kembalikan !!!",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Ya, hapus data!",
                                                closeOnConfirm: false
                                            },
                                            function () {
                                                swal("data dihapus!", "", "success")
                                                window.location = '{{ url("delwalimurid") }}/' +
                                                    id;

                                            }



                                        );

                                    }

                                </script>

                                <div id="e{{ $value->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Form Update data Wali Murid</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('updatewalimurid') }}"
                                                    method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label>Nama Wali Murid</label>
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <input type="text" class="form-control" name="nama" value="{{ $value->nama }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No HP</label>
                                                        <input type="text" value="{{ $value->nohp }}" class="form-control" name="nohp">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" value="{{ $value->email }}" class="form-control" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea name="alamat"
                                                            style="width:100%;height:50px;">{{ $value->alamat }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Siswa</label>
                                                        <select style="width:100%" name="id_siswa[]" multiple class="form-control select2" required>
                                                            <option value="">--Pilih Siswa--</option>
                                                            @foreach($siswa as $i => $vs)
                                                                <option value="{{ $vs->id_siswa }}" @if(in_array($vs->id_siswa,explode(',',$value->id_siswa))) selected @endif>{{ $vs->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            >
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>
                                                    Simpan</button>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->



@endsection
