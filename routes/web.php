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

Route::get('/', function () {
    return view('index');
});
Route::get('/pdf', 'Laporan@index');
Route::post('/api/login','API\admin\User@cekLogin');

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

//API RESEPSIONIS
Route::get('/api/pilih-kamar/{id}','API\resepsionis\PilihKamar@index');
Route::post('/api/transaksi','API\resepsionis\Transaksi@tambahTransaksi');
Route::get('/api/transaksi','API\resepsionis\Transaksi@index');
Route::get('/api/transaksi/detail/{id}','API\resepsionis\Transaksi@detailTransaksi');
