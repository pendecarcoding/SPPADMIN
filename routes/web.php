<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login/admin/');
});
Route::get('/login/admin/','AdminController@login');
Route::match(['get','post'],'/loginPost','AdminController@loginPost');

Route::group(['middleware'=>['usersession']],
function(){

    Route::get('/logout','AdminController@logout');
    Route::get('/admin','AdminController@admin');
    Route::get('/admin/pengaturan','AdminController@pengaturan');


    Route::match(['get','post'],'/updateadmin','AdminController@updateadmin');
    Route::match(['get','post'],'/updateoperator','AdminController@updateopr');
    Route::match(['get','post'],'/updateprivasi','AdminController@updateprivasi');
    Route::match(['get','post'],'/updateprivasiope','AdminController@updateprivasiope');
    Route::match(['get','post'],'/updateinstansi','AdminController@updateinstansi');

    //Data datapegawai
    //Data operator
    Route::match(['get','post'],'/master/dataoperator','AdminController@dataoperator');
    Route::match(['get','post'],'/master/dataoperator/tambah','AdminController@tambahdataop');
    Route::match(['get','post'],'/tambahop','AdminController@tambahoperator');
    Route::match(['get','post'],'/updateop','AdminController@updateoperator');
    Route::match(['get','post'],'/updateoppriv','AdminController@updateprivasiop');
    Route::match(['get','post'],'/deleteop/{id}','AdminController@hapusop');
    Route::match(['get','post'],'/updatehak','AdminController@updatehak');
    Route::match(['get','post'],'/master/dataoperator/edit/{id}','AdminController@editop');

    //Pengaturan operator
    Route::get('/operator/pengaturan','AdminController@pengaturanop');
    //Pengaturan Sekolah
    Route::match(['get','post'],'/operator/pengaturan/sekolah','SekolahController@pengaturansekolah');
    Route::match(['get','post'],'/updatedatasekolah','SekolahController@updatedatasekolah');
    Route::match(['get','post'],'/uploadlogo','SekolahController@uploadlogo');
    Route::match(['get','post'],'/chart','SekolahController@chart');
    Route::match(['get','post'],'/chartpengeluaran','SekolahController@chartpe');

    //Pembayaran
    Route::match(['get','post'],'/pembayaran/pembayaransiswa','PembayaranController@pembayaran');
    Route::match(['get','post'],'/pembayaran/hasilcaripembayaran/','PembayaranController@hasilcaripembayaran');
    Route::match(['get','post'],'/pdf/cetakbayarbulanan/{id}/{nis}/{th}','PembayaranController@cetakbayarbulanan');
    Route::match(['get','post'],'/pdf/cetaktagihanlainnya/{id}/{nis}/{tahun}','PembayaranController@cetaktagihanlainnya');
    Route::match(['get','post'],'/pdf/cetaksemuatagihanlainnya/{tahun}/{nis}','PembayaranController@cetaksemuatagihanlainnya');
    //Keuangan
    Route::match(['get','post'],'/keuangan/poskeuangan','KeuanganController@poskeuangan');
    Route::match(['get','post'],'/tambahpos','KeuanganController@tambahpos');
    Route::match(['get','post'],'/deletepos/{id}','KeuanganController@deletepos');
    Route::match(['get','post'],'/keuangan/poskeuangan/edit/{id}','KeuanganController@poskeuanganedit');
    Route::match(['get','post'],'/updatepos','KeuanganController@updatepos');

    //Jenis pembayaransiswa
    Route::match(['get','post'],'/payment/jenis_pay','PaymentController@jenis');
    Route::match(['get','post'],'/payment/jenis_pay/edit/{id}','PaymentController@jenisedit');
    Route::match(['get','post'],'/tambahpayment','PaymentController@tambahpayment');
    Route::match(['get','post'],'/deletepay/{id}','PaymentController@deletepay');
    Route::match(['get','post'],'/payment/bulanan/{id}','PaymentController@bulanan');
    Route::match(['get','post'],'/payment/bulanancari/{id}/{kelas}/{tahun}','PaymentController@bulanancari');
    Route::match(['get','post'],'/payment/bebas/{id}','PaymentController@bebas');
    Route::match(['get','post'],'/updatepayment','PaymentController@updatepayment');
    Route::match(['get','post'],'/tambahtarfibulan','PaymentController@tambahtarfibulan');
    Route::match(['get','post'],'/payment/bebas/{id}','PaymentController@bebas');
    Route::match(['get','post'],'/payment/bebascari/{id}/{kls}','PaymentController@bebascari');
    Route::match(['get','post'],'/tambahtarifbebas','PaymentController@tambahtarifbebas');
    Route::match(['get','post'],'/pembayaran/bulanan/{id}/{nis}/{th}','PaymentController@viewbayarspp');
    Route::match(['get','post'],'/bayarbulanan/{id}/{nis}/{hrg}/{idp}/{th}','PaymentController@bayarbulanan');
    Route::match(['get','post'],'/bayarbebas','PaymentController@bayarbebas');


    //Pemasukan
    Route::match(['get','post'],'/jurnalumum/pemasukan','JurnalController@pemasukan');
    Route::match(['get','post'],'/tambahsumber','JurnalController@tambahsumber');
    Route::match(['get','post'],'/deletepemasukan/{id}','JurnalController@delpemasukan');
    Route::match(['get','post'],'/jurnalumum/pemasukan/edit/{id}','JurnalController@editpemasukan');
    Route::match(['get','post'],'/updatesumber','JurnalController@updatesumber');

    //Kategori Pengeluaran
    Route::match(['get','post'],'/jurnalumum/jenispengeluaran','JurnalController@jenispengeluaran');
    Route::match(['get','post'],'/deletejenispengeluaran/{id}','JurnalController@deljenispengeluaran');
    Route::match(['get','post'],'/tambahjenispengeluaran','JurnalController@tambahjenispengeluaran');
    Route::match(['get','post'],'/updatejenispengeluaran','JurnalController@updatejenispengeluaran');
    Route::match(['get','post'],'/jurnalumum/jenispengeluaran/edit/{id}','JurnalController@jenispengeluaranedit');

    //Pengeluaran
    Route::match(['get','post'],'/jurnalumum/pengeluaran','JurnalController@pengeluaran');
    Route::match(['get','post'],'/tambahpengeluaran','JurnalController@tambahpengeluaran');
    Route::match(['get','post'],'/updatepengeluaran','JurnalController@updatepengeluaran');
    Route::match(['get','post'],'/deletepengeluaran/{id}','JurnalController@delpengeluaran');
    Route::match(['get','post'],'/jurnalumum/pengeluaran/edit/{id}','JurnalController@pengeluaranedit');

    //Guru
    Route::match(['get','post'],'/datamaster/dataguru','GuruController@index');
    Route::match(['get','post','put'],'/datamaster/editguru/{id}','GuruController@index');
    Route::match(['get','post','put'],'/datamaster/updateguru/{id}','GuruController@update');
    Route::match(['get','post'],'/tambahguru','GuruController@create');
    Route::match(['get','post'],'/delguru/{id}','GuruController@delete');


    //Data WaliMurid
    Route::match(['get','post'],'/datamaster/walimurid','WalimuridController@index');
    Route::match(['get','post'],'/addwalimurid','WalimuridController@create');
    Route::match(['get','post'],'/delwalimurid/{id}','WalimuridController@delete');
    Route::match(['get','post'],'/updatewalimurid','WalimuridController@update');

    // Kesehatan Siswa
    Route::match(['get','post'],'/kesehatansiswa','KesehatanController@index');
    Route::match(['get','post'],'/addinfokesehatan','KesehatanController@add');
    Route::match(['get','post'],'/updateinfokesehatan','KesehatanController@update');
    Route::match(['get','post'],'/delkesehatan/{id}','KesehatanController@delete');

    //Hafalan
    Route::match(['get','post'],'/hafalansiswa','HafalanController@index');
    Route::match(['get','post'],'/addinfohafalan','HafalanController@add');
    Route::match(['get','post'],'/delhafalan/{id}','HafalanController@delete');
    Route::match(['get','post'],'/updateinfohafalan','HafalanController@update');




    //Data Wlikelas
    Route::match(['get','post'],'/datamaster/datawalikelas','KelasController@datawalikelas');
    Route::match(['get','post'],'/tambahwalikelas','KelasController@addwalikelas');
    Route::match(['get','post'],'/generateakseswk/{id}','KelasController@generateakses');
    Route::match(['get','post'],'/deletewalikelas/{id}','KelasController@deletewalikelas');

    //datakelas
    Route::match(['get','post'],'/datamaster/datakelas','KelasController@kelas');
    Route::match(['get','post'],'/tambahkelas','KelasController@tambahkelas');
    Route::match(['get','post'],'/delkelas/{id}','KelasController@delkelas');
    Route::match(['get','post'],'/datamaster/datakelas/edit/{id}','KelasController@kelasedit');
    Route::match(['get','post'],'/updatekelas','KelasController@updatekelas');

    //Data Siswa
    Route::match(['get','post'],'/datamaster/datasiswa','SiswaController@siswa');
    Route::match(['get','post'],'/tambahsiswa','SiswaController@tambahsiswa');
    Route::match(['get','post'],'/delsis/{id}','SiswaController@delsis');
    Route::match(['get','post'],'/datamaster/datasiswa/edit/{id}','SiswaController@siswaedit');
    Route::match(['get','post'],'/updatesiswa','SiswaController@updatesiswa');
    Route::match(['get','post'],'/importsiswa','SiswaController@importsiswa');

    //Laporan
    Route::match(['get','post'],'/laporan/laporanbulanan','LaporanController@laporanbulanan');
    Route::match(['get','post'],'/laporan/laporantahunan','LaporanController@laporantahunan');
    Route::match(['get','post'],'/laporan/laporanpenerimaan/','LaporanController@cetakpenerimaan');
    Route::match(['get','post'],'/laporan/laporanpengeluaran/','LaporanController@cetakpengeluaran');
    Route::match(['get','post'],'/laporan/laporantunggakan/','LaporanController@laporantunggakan');

    //Kenaikan Kelas
    //SET KENAIKAN
Route::match(['get','post'],'/kenaikan/setkenaikan','KenaikanController@setkenaikan');
Route::match(['get','post'],'/kenaikan/lihatsiswakelas/','KenaikanController@lihatsiswakelas');
Route::match(['get','post'],'/aksinaikkelas','KenaikanController@aksinaikkelas');
Route::match(['get','post'],'/kelulusan/setkelulusan','KenaikanController@setkelulusan');
Route::match(['get','post'],'/kelulusan/lihatsiswakelas/','KenaikanController@lihatsiswakelaslulus');
Route::match(['get','post'],'/aksilulus','KenaikanController@aksilulus');

//Pembayaran paymentkhusus
Route::match(['get','post'],'/payment/paymentkhusus','PaymentController@tarifkhusus');
Route::match(['get','post'],'/tambahpaymentkhusus','PaymentController@tambahpaymentkhusus');
Route::match(['get','post'],'/payment/jenis_paykhusus/edit/{id}','PaymentController@jeniskhususedit');
Route::match(['get','post'],'/updatepaymentkhusus','PaymentController@updatepaymentkhusus');
Route::match(['get','post'],'/deletepaykhusus/{id}','PaymentController@deletepaykhusus');

//kebijakan
Route::match(['get','post'],'/keuangan/kebijakan','KebijakanController@kebijakan');
Route::match(['get','post'],'/tambahkebijakan','KebijakanController@kebijakantambah');
Route::match(['get','post'],'/deletekebijakan/{id}','KebijakanController@delkeb');
Route::match(['get','post'],'/updatekebijakan','KebijakanController@updatekeb');
Route::match(['get','post'],'/keuangan/kebijakan/edit/{id}','KebijakanController@kebijakanedit');

//Tarif Set Khusus

Route::match(['get','post'],'/payment/bulanankhusus/{id}','PaymentController@bulanankhusus');
Route::match(['get','post'],'/payment/bulanancarikhusus/{id}/{kelas}/{tahun}','PaymentController@bulanancarikhusus');
Route::match(['get','post'],'/tambahtarfibulankhusus','PaymentController@tambahtarfibulankhusus');



});

