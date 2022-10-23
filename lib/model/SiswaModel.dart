import 'package:mvc_pattern/mvc_pattern.dart';

class SiswaModel extends ModelMVC {
  SiswaModel({
    required this.success,
    required this.message,
    required this.data,
  });

  bool success;
  String message;
  List<Datum> data;
}

class Datum {
  Datum({
    required this.idSiswa,
    required this.nis,
    required this.nama,
    required this.tptLahir,
    required this.tglLahir,
    required this.idKelas,
    required this.namaIbu,
    required this.foto,
    required this.alamat,
    required this.idSekolahsiswa,
    required this.idtahunmasuksiswa,
    required this.statussiswa,
  });

  int idSiswa;
  String nis;
  String nama;
  String tptLahir;
  DateTime tglLahir;
  int idKelas;
  String namaIbu;
  String foto;
  String alamat;
  int idSekolahsiswa;
  int idtahunmasuksiswa;
  String statussiswa;
}
