<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruModel extends Model
{
  protected $table = 'tbl_guru';
  public $timestamps = false;
  protected $fillable = [
        'id_guru',
        'nip',
        'nama_guru',
        'alamat',
        'nohp',
        'email',
        'id_sekolah',
    ];
}
