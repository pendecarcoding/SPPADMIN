<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KesehatanModel extends Model
{
  protected $table = 'tbl_kesehatan';
  public $timestamps = true;
  protected $fillable = [
        'id_siswa',
        'id_kelas',
        'kesehatan',
        'tgl_checkup',
        'id_sekolah',
    ];
}
