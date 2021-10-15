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

/* Nama Route: siswa
 * URL Route: /siswa/
 */
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', 'SiswaController@index')->name('home');
    Route::get('/login', 'SiswaLoginController@loginForm')->name('login');
    Route::post('/login', 'SiswaLoginController@login')->name('login.submit');
    Route::get('/logout', 'SiswaLoginController@logout')->name('logout');
});

/* Nama Route: admin
 * URL Route: /admin/
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('home');

    Route::get('/login', 'AdminLoginController@loginForm')->name('login');
    Route::post('/login', 'AdminLoginController@login')->name('login.submit');
    Route::get('/logout', 'AdminLoginController@logout')->name('logout');

    Route::get('/pengaturan', 'AdminController@pengaturan')->name('pengaturan');
    Route::post('/pengaturan', 'AdminController@pengaturanSubmit')->name('pengaturan.submit');

    /* Nama Route: admin.data
     * URL Route: /admin/data/
     */
    Route::prefix('data')->group(function () {

        /* Nama Route: admin.data.siswa
         * URL Route: /admin/data/siswa/
         */
        Route::prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', 'DataSiswaController@index')->name('data');
            Route::post('/', 'DataSiswaController@cari')->name('cari');

            Route::post('/tambah', 'DataSiswaController@tambah')->name('tambah');
            Route::post('/edit', 'DataSiswaController@edit')->name('edit');
            Route::post('/update', 'DataSiswaController@update')->name('update');
            Route::post('/hapus', 'DataSiswaController@hapus')->name('hapus');
        });

        /* Nama Route: admin.data.industri
         * URL Route: /admin/data/industri/
         */
        Route::prefix('industri')->name('industri.')->group(function () {
            Route::get('/', 'DataIndustriController@index')->name('data');
            Route::post('/', 'DataIndustriController@cari')->name('cari');

            Route::permanentRedirect('/{id}', '/admin/data/industri')->where('id', '[0-9]+');
            Route::post('/{id}', 'DataIndustriController@informasi')->where('id', '[0-9]+')->name('informasi');

            Route::permanentRedirect('/tambah', '/admin/data/industri');
            Route::post('/tambah', 'DataIndustriController@tambah')->name('tambah');
            Route::permanentRedirect('/hapus', '/admin/data/industri');
            Route::post('/hapus', 'DataIndustriController@hapus')->name('hapus');
            Route::permanentRedirect('/update', '/admin/data/industri');
            Route::post('/update', 'DataIndustriController@update')->name('update');
        });
    });
});

// Pengguna memasuki halaman yang tidak ada
Route::fallback(function () {
    return redirect()->back();
});
