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
    Route::get('/data/siswa', 'AdminController@dataSiswa')->name('admin.data.siswa');
    Route::post('/data/siswa', 'AdminController@tambahSiswa')->name('admin.tambah.siswa');
});
