// To parse this JSON data, do
//
//     final datasMain = datasMainFromJson(jsonString);

import 'dart:convert';

StudentModel datasMainFromJson(String str) =>
    StudentModel.fromJson(json.decode(str));

String studentModelToJson(StudentModel data) => json.encode(data.toJson());

class StudentModel {
  StudentModel({
    this.datas,
  });

  List<Data>? datas;

  factory StudentModel.fromJson(Map<String, dynamic> json) => StudentModel(
        datas: json["data"] == null
            ? null
            : List<Data>.from(json["data"].map((x) => Data.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "data": datas == null
            ? null
            : List<dynamic>.from(datas!.map((x) => x.toJson())),
      };
}

class Data {
  Data({
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

  factory Data.fromJson(Map<String, dynamic> json) => Data(
        idSiswa: json["id_siswa"] == null ? null : json["id_siswa"],
        nis: json["nis"] == null ? null : json["nis"],
        nama: json["nama"] == null ? null : json["nama"],
        tptLahir: json["tpt_lahir"] == null ? null : json["tpt_lahir"],
        tglLahir: json["tgl_lahir"] == null ? null : json["tgl_lahir"],
        idKelas: json["id_kelas"] == null ? null : json["id_kelas"],
        namaIbu: json["nama_ibu"] == null ? null : json["nama_ibu"],
        foto: json["foto"] == null ? null : json["foto"],
        alamat: json["alamat"] == null ? null : json["alamat"],
        idSekolahsiswa:
            json["id_sekolahsiswa"] == null ? null : json["id_sekolahsiswa"],
        idtahunmasuksiswa: json["idtahunmasuksiswa"] == null
            ? null
            : json["idtahunmasuksiswa"],
        statussiswa: json["statussiswa"] == null ? null : json["statussiswa"],
      );

  Map<String, dynamic> toJson() => {
        "id_siswa": idSiswa == null ? null : idSiswa,
        "nis": nis == null ? null : nis,
        "nama": nama == null ? null : nama,
        "tpt_lahir": tptLahir == null ? null : tptLahir,
        "tgl_lahir": tglLahir == null ? null : tglLahir,
        "id_kelas": idKelas == null ? null : idKelas,
        "nama_ibu": namaIbu == null ? null : namaIbu,
        "foto": foto == null ? null : foto,
        "alamat": alamat == null ? null : alamat,
        "id_sekolahsiswa": idSekolahsiswa == null ? null : idSekolahsiswa,
        "idtahunmasuksiswa":
            idtahunmasuksiswa == null ? null : idtahunmasuksiswa,
        "statussiswa": statussiswa == null ? null : statussiswa,
      };
}

// enum OriginalTitle { EMPTY, ANNIHILATION, A_WRINKLE_IN_TIME, THE_LEISURE_SEEKER, CE_QUI_NOUS_LIE }

/*final originalTitleValues = EnumValues({
  "Annihilation": OriginalTitle.ANNIHILATION,
  "A Wrinkle in Time": OriginalTitle.A_WRINKLE_IN_TIME,
  "Ce qui nous lie": OriginalTitle.CE_QUI_NOUS_LIE,
  "": OriginalTitle.EMPTY,
  "The Leisure Seeker": OriginalTitle.THE_LEISURE_SEEKER
});*/

class EnumValues<T> {
  late Map<String, T> map;
  late Map<T, String> reverseMap;

  EnumValues(this.map);

  Map<T, String> get reverse {
    if (reverseMap == null) {
      reverseMap = map.map((k, v) => new MapEntry(v, k));
    }
    return reverseMap;
  }
}
