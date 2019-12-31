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

Route::get('/', 'SiteController@home');
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');
Route::get('/about', 'SiteController@about');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('auth.postlogin');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');

Route::group(['middleware' => ['auth','checkrole:admin']],function(){
	Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
	Route::post('/siswa/create', 'SiswaController@create')->name('siswa.create');
	Route::get('/siswa/{siswa}/edit', 'SiswaController@edit')->name('siswa.edit');
	Route::post('/siswa/{siswa}/update', 'SiswaController@update')->name('siswa.update');
	Route::get('/siswa/{siswa}/delete', 'SiswaController@delete')->name('siswa.delete');
	Route::get('/siswa/{siswa}/profile', 'SiswaController@profile')->name('siswa.profile');
	Route::post('/siswa/{siswa}/addnilai', 'SiswaController@addnilai')->name('siswa.addnilai');
	Route::get('/siswa/{siswa}/{idmapel}/deletenilai','SiswaController@deletenilai')->name('siswa.deletenilai');
	Route::get('/siswa/exportexcell', 'SiswaController@exportexcell')->name('siswa.export');
	Route::get('/siswa/exportpdf', 'SiswaController@exportpdf')->name('siswa.exportpdf');
	Route::get('/guru/{id}/profile','GuruController@profile')->name('guru.profile');
});

Route::group(['middleware' => ['auth','checkrole:admin,siswa']],function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

});