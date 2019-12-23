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
    return view('home');
});
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('auth.postlogin');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');

Route::group(['middleware' => ['auth','checkrole:admin']],function(){
	Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
	Route::post('/siswa/create', 'SiswaController@create')->name('siswa.create');
	Route::get('/siswa/{id}/edit', 'SiswaController@edit')->name('siswa.edit');
	Route::post('/siswa/{id}/update', 'SiswaController@update')->name('siswa.update');
	Route::get('/siswa/{id}/delete', 'SiswaController@delete')->name('siswa.delete');
	Route::get('/siswa/{id}/profile', 'SiswaController@profile')->name('siswa.profile');
	Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai')->name('siswa.addnilai');
});

Route::group(['middleware' => ['auth','checkrole:admin,siswa']],function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

});