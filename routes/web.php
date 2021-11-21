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

Auth::routes([
    'register' => false,
    'reset' => false,
]);

/* Route: /
 */
Route::view('/tentang', 'tentang')->name('tentang');

Route::get('/pemetaan', 'PemetaanController@index')->name('pemetaan');
Route::get('/detail/{id}', 'PemetaanController@detail')->name('detail');

/* Nama Route: siswa
 * URL Route: /
 */
Route::name('siswa.')->group(function () {
    Route::get('/', 'SiswaController@index')->name('home');

    Route::get('/login', 'SiswaLoginController@index')->name('login');
    Route::post('/login', 'SiswaLoginController@login')->name('login.submit');
    Route::get('/logout', 'SiswaLoginController@logout')->name('logout');

    Route::get('/pengaturan', 'SiswaController@pengaturan')->name('pengaturan');
    Route::post('/pengaturan', 'SiswaController@pengaturanSubmit')->name('pengaturan.submit');

    Route::get('/ajukan', 'AjukanController@index')->name('ajukan');
    Route::post('/ajukan', 'AjukanController@submit')->name('ajukan.submit');

    Route::get('/pilih', 'SiswaController@pilih')->name('pilih');
    Route::get('/pilih/{id}', 'SiswaController@detail')->where('id', '[0-9]+')->name('pilih.detail');
    Route::post('/pilih', 'SiswaController@pilihSubmit')->name('pilih.submit');
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

    /* Nama Route: admin
     * URL Route: /admin/data/
     */
    Route::prefix('data')->group(function () {

        /* Nama Route: admin.siswa
         * URL Route: /admin/data/siswa/
         */
        Route::prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', 'DataSiswaController@index')->name('data');

            Route::post('/tambah', 'DataSiswaController@tambah')->name('tambah');
            Route::post('/edit', 'DataSiswaController@edit')->name('edit');
            Route::post('/update', 'DataSiswaController@update')->name('update');
            Route::post('/hapus', 'DataSiswaController@hapus')->name('hapus');
            Route::post('/kick', 'DataSiswaController@kick')->name('kick');

            Route::get('/download', 'DataSiswaController@download')->name('download');
            Route::post('/upload', 'DataSiswaController@upload')->name('upload');
        });

        /* Nama Route: admin.industri
         * URL Route: /admin/data/industri/
         */
        Route::prefix('industri')->name('industri.')->group(function () {
            Route::get('/', 'DataIndustriController@index')->name('data');
            Route::post('/{id}', 'DataIndustriController@informasi')->where('id', '[0-9]+')->name('informasi');

            Route::post('/tambah', 'DataIndustriController@tambah')->name('tambah');
            Route::post('/hapus', 'DataIndustriController@hapus')->name('hapus');
            Route::post('/update', 'DataIndustriController@update')->name('update');

            Route::get('/download', 'DataIndustriController@download')->name('download');
            Route::post('/upload', 'DataIndustriController@upload')->name('upload');
        });
    });
});

// Pengguna memasuki halaman yang tidak ada
Route::fallback(function () {
    return redirect()->back();
});
