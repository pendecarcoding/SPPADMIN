<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WmModel extends Model
{
  protected $table = 'tbl_walimurid';
  public $timestamps = false;
  protected $fillable = [
        'nama',
        'nohp',
        'alamat',
        'email',
        'password',
        'id_sekolah',
        'id_siswa',
    ];
}
