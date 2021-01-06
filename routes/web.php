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

Route::get('/', 'WelcomeController@index');

Route::Resource('departemen', 'DepartemenController');
Route::Resource('jabatan', 'JabatanController');
Route::Resource('karyawan', 'KaryawanController');
Route::get('/rawdata', 'KaryawanController@dataabsen');
Route::get('/karyawan/{karyawan}/{tanggal}/{status}', 'KaryawanController@iptabsen');
Route::post('/karyawan/{karyawan}/{tanggal}/{status}', 'KaryawanController@sviptabsen');
Route::post('/karyawan/{karyawan}/izin', 'KaryawanController@iptizin');
Route::Resource('jamkerja', 'JamKerjaController');
Route::Resource('mesin', 'MesinController');
Route::get('/uploadnama', 'UploadController@uploadnama');
Route::post('/uploadnama', 'UploadController@downloadattlog');
Route::get('/downattlog', 'UploadController@downloadattlogindex');
Route::post('/downattlog/imp', 'UploadController@importattlog');
Route::Resource('kalender', 'KalenderController');
Route::Resource('laporan', 'LaporanController');
Route::post('laporan/coba', 'LaporanController@coba');
Route::post('laporan/test', 'LaporanController@test');
//Route::post('laporan/coba/exp', 'LaporanController@cetak_pdf');
Route::get('laporan/export/{id_dpt}/{bln}/{thn}', 'LaporanController@cetak_pdf');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
