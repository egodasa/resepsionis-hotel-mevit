<?php

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

Route::get('vue', function () {
    return view('halamanvue');
});
Route::get('vue2', function () {
    return view('halamanvue2');
});
Route::get('form', function () {
    return view('halamanform');
});
Route::get('tabel', function () {
    return view('tabel');
});
Route::get('list', function () {
    return view('list');
});
Route::get('tabs', function () {
    return view('tabs');
});


Route::get('/', function () {
    return view('admin/index');
});
Route::post('/api/login','API\admin\User@cekLogin');

Route::group(['prefix'=>'admin'],function(){
	Route::get('/','Admin@index');
	Route::get('/dosen',function (){
		return view('admin/kelolaDosen');
	});
	Route::get('/mahasiswa',function (){
		return view('admin/kelolaMahasiswa');
	});
	Route::get('/jenis-soal',function (){
		return view('admin/kelolaJsoal');
	});
	Route::get('/jenis-ujian',function (){
		return view('admin/kelolaJujian');
	});
	Route::get('/kelas',function (){
		return view('admin/kelolaKelas');
	});
	Route::get('/matkul',function (){
		return view('admin/kelolaMatkul');
	});
});

Route::group(['prefix'=>'dosen/{nidn}'],function($nidn){
	Route::get('/','Dosen@index');
	Route::get('/kuliah',function ($nidn){
		return view('dosen/kelolaKuliah',["_NIDN"=>$nidn]);
	});
	Route::get('/ujian',function ($nidn){
		return view('dosen/kelolaUjian',["_NIDN"=>$nidn]);
	});
});

//START OF ADMIN API
Route::group(['prefix'=>'api/daftar-kamar'],function(){
	Route::get('/','API\admin\DaftarKamar@index');
	Route::get('/{id}','API\admin\DaftarKamar@show');
	Route::match(['post','put'],'/{id?}','API\admin\DaftarKamar@store');
	Route::delete('/{id}','API\admin\DaftarKamar@destroy');
});
Route::group(['prefix'=>'api/tipe-kamar'],function(){
	Route::get('/','API\admin\TipeKamar@index');
	Route::get('/{id}','API\admin\TipeKamar@show');
	Route::match(['post','put'],'/{id?}','API\admin\TipeKamar@store');
	Route::delete('/{id}','API\admin\TipeKamar@destroy');
});
Route::group(['prefix'=>'api/pernah-pesan'],function(){
	Route::get('/','API\admin\PernahPesan@index');
	Route::get('/{id}','API\admin\PernahPesan@show');
	Route::match(['post','put'],'/{id?}','API\admin\PernahPesan@store');
	Route::delete('/{id}','API\admin\PernahPesan@destroy');
});
Route::group(['prefix'=>'api/user'],function(){
	Route::get('/','API\admin\User@index');
	Route::get('/{id}','API\admin\User@show');
	Route::match(['post','put'],'/{id?}','API\admin\User@store');
	Route::delete('/{id}','API\admin\User@destroy');
});

//EOF API ADMIN

//START OF DOSEN API
Route::group(['prefix'=>'api/dosen/{nidn}'],function($nidn){
	Route::get('/kuliah',['uses'=>'API\dosen\Kuliah@index']);
	Route::post('/kuliah',['uses'=>'API\dosen\Kuliah@store']);
	Route::get('/ujian',['uses'=>'API\dosen\Ujian@index']);
});
//EOF DOSEN API
