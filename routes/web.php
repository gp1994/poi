
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

Route::get('/', 'UtamaController@gmaps');

Route::post('/login','PenggunaController@cekLogin');

Route::get('/login',  function(){
	return view('login');
});

Route::get('/detres',  function(){
	return view('detres');
});

Route::get('/utres',  function(){
	return view('utres');
});

Route::get('/datatable', 'UtamaController@infoutama');

Route::post('/editloc','UtamaController@editloc');

Route::post('/storeloc','UtamaController@storeloc');

Route::get('/detable', 'UtamaController@infodetail');

Route::post('/storedet','UtamaController@storedet');

Route::post('/editdet','UtamaController@editdet');

Route::get('/logout', 'PenggunaController@logout');

Route::get('/downloadPDF/{id}','UtamaController@downloadPDF');