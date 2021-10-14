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

Route::view('/', 'dashboard')->name('home');
Route::view('/tentang', 'tentang')->name('tentang');

Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::prefix('siswa')->group(function () {
    Route::get('/', 'SiswaController@index')->name('siswa.home');
    Route::get('/login', 'SiswaLoginController@loginForm')->name('siswa.login');
    Route::post('/login', 'SiswaLoginController@login')->name('siswa.login.submit');
    Route::get('/logout', 'SiswaLoginController@logout')->name('siswa.logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');

    Route::get('/login', 'AdminLoginController@loginForm')->name('admin.login');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminLoginController@logout')->name('admin.logout');

    Route::get('/pengaturan', 'AdminController@pengaturan')->name('admin.pengaturan');
    Route::post('/pengaturan', 'AdminController@pengaturanSubmit')->name('admin.pengaturan.submit');

    Route::get('/data/siswa', 'DataSiswaController@index')->name('admin.data.siswa');
    Route::post('/data/siswa', 'DataSiswaController@cari')->name('admin.cari.siswa');

    Route::permanentRedirect('/data/siswa/tambah', '/admin/data/siswa');
    Route::post('/data/siswa/tambah', 'DataSiswaController@tambah')->name('admin.tambah.siswa');
    Route::permanentRedirect('/data/siswa/edit', '/admin/data/siswa');
    Route::post('/data/siswa/edit', 'DataSiswaController@edit')->name('admin.edit.siswa');
    Route::permanentRedirect('/data/siswa/update', '/admin/data/siswa');
    Route::post('/data/siswa/update', 'DataSiswaController@update')->name('admin.update.siswa');
    Route::permanentRedirect('/data/siswa/hapus', '/admin/data/siswa');
    Route::post('/data/siswa/hapus', 'DataSiswaController@hapus')->name('admin.hapus.siswa');

    Route::get('/data/industri', 'DataIndustriController@index')->name('admin.data.industri');
    Route::permanentRedirect('/data/industri/{id}', '/admin/data/industri')->where('id', '[0-9]+');
    Route::post('/data/industri/{id}', 'DataIndustriController@informasi')->where('id', '[0-9]+')->name('admin.informasi.industri');

    Route::permanentRedirect('/data/industri/tambah', '/admin/data/industri');
    Route::post('/data/industri/tambah', 'DataIndustriController@tambah')->name('admin.tambah.industri');
    Route::permanentRedirect('/data/industri/hapus', '/admin/data/industri');
    Route::post('/data/industri/hapus', 'DataIndustriController@hapus')->name('admin.hapus.industri');
    Route::permanentRedirect('/data/industri/update', '/admin/data/industri');
    Route::post('/data/industri/update', 'DataIndustriController@update')->name('admin.update.industri');
});
