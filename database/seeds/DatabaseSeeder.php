<?php

use Illuminate\Database\Seeder;
use App\SekolahModel;
use App\BulanModel;
use App\PengaturanModel;
use App\TahunModel;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

   SekolahModel::create([
        'nm_sekolah'	=> 'SMPS BEQURANIC BENGKALIS',
        'al_sekolah'	=> 'JL. Utama Pangkalan Batang',
        'kecamatan'	    => 'Bengkalis',
        'kabupaten'	    => 'Bengkalis',
        'nm_kepsek'	    => 'Sumi Purwayi',
        'logo'	        => '6338004edc60b.png',
        'nip_kepsek'    => '-',
        'bendahara'     => '-',
        'nipbendahara' => '-',
        'website'       => 'http://bequranic.com',
        'email'         => 'smppiq.17@gmail.com',
        'nohp'          => '2147483647']
    );

    PengaturanModel::create([
        'username'	    => 'admin',
        'password'	    => md5('admin'),
        'nama'	        => 'admin',
        'jabatan'	    => 'Administrator',
        'nohpuser'	    => '082235993763',
        'idsekolah'	    => '1',
        'level'         => 'operator',
        'foto'          => 'admin.png',
        'colour'        => 'blue',
        'created_at'    => now(),
        'updated_at'    => now()
        ]
    );
    TahunModel::create([
        'tahun'	        => '2022/2023',
        'status'	    => 'Y'
        ]
    );

    BulanModel::insert([[
          'bulan'=>'Januari',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
        [
          'bulan'=>'Februari',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Maret',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'April',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Mei',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Juni',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Juli',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Agustus',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'September',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Oktober',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'November',
          'created_at'=>now(),
          'updated_at'=>now()
        ],
         [
          'bulan'=>'Desember',
          'created_at'=>now(),
          'updated_at'=>now()
        ]]);




    }
}
