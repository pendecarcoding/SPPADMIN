<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HafalanModel extends Model
{
  protected $table = 'tbl_hafalan';
  public $timestamps = true;
  protected $fillable = [
        'id',
        'id_siswa',
        'id_kelas',
        'batas_hafalan',
        'tgl_setor',
        'id_sekolah',
    ];
}
