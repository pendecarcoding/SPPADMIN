<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WkModel extends Model
{
  protected $table = 'tbl_walikelas';
  public $timestamps = false;
  protected $fillable = [
        'id_guru',
        'id_kelas',
        'id_tahun',
    ];
}
