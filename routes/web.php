<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('overview.home');
});

Route::get('/', 'App\Http\Controllers\AdminController@welcomeView');
Route::get('/welcome', 'App\Http\Controllers\AdminController@welcomeView');
// Route::get('/welcome', function () {
//     return view('overview.home');
// });

Route::get('/navigation', function () {
    return view('navbar');
});


//Login & Logout & Register
Route::get('/login', 'App\Http\Controllers\AdminController@adminLogin');
Route::get('/logout', 'App\Http\Controllers\AdminController@logoutSession');

//Session Register beserta empty data handling
Route::prefix('register')->group(function () {
    Route::get('', function () {
        return view('user.register');
    });
    Route::post('/authenticate', 'App\Http\Controllers\AdminController@registerAuthenticate');
});

//Route ke page koleksi dengan menampilkan data buku-buku untuk user
Route::get('/koleksi', 'App\Http\Controllers\AdminController@koleksiBuku');

//Admin Page beserta page2 nya
Route::prefix('admin')->group(function () {
    //melakukan verifikasi jika admin
    Route::post('/authenticate', 'App\Http\Controllers\AdminController@adminAuthenticate');
    
    //routing page koleksi, add, edit, dan delete buku
    Route::prefix('koleksi')->group(function(){
        Route::get('', 'App\Http\Controllers\AdminController@koleksiBuku');
        Route::post('/edit', 'App\Http\Controllers\AdminController@editBuku');
        Route::post('/updateBuku', 'App\Http\Controllers\AdminController@updateBuku');
        Route::get('/tambah', function () {
            return view('koleksi.tambahBuku');
        });
        Route::post('/tambahBuku', 'App\Http\Controllers\AdminController@tambahBuku');
    });
    Route::prefix('anggota')->group(function(){
        Route::get('', 'App\Http\Controllers\AdminController@anggota');
        Route::post('/edit', 'App\Http\Controllers\AdminController@selectAnggota');
        Route::post('/cekUpdate', 'App\Http\Controllers\AdminController@updateAnggota');
        Route::get('/tambah', 'App\Http\Controllers\AdminController@anggotaBaru');
    });
    Route::prefix('peminjaman')->group(function(){
        Route::get('/pinjam', 'App\Http\Controllers\AdminController@daftarPeminjam');
        Route::post('/daftarPinjam', 'App\Http\Controllers\AdminController@pinjamBuku');

        Route::get('/pengembalian', 'App\Http\Controllers\AdminController@daftarPengembalian');
        Route::post('/formPengembalian', 'App\Http\Controllers\AdminController@formPengembalian');
        Route::post('/returBuku', 'App\Http\Controllers\AdminController@returBuku');

        Route::get('/statusPeminjaman', 'App\Http\Controllers\AdminController@statusPengembalian');
        Route::post('/editStatusPeminjaman', 'App\Http\Controllers\AdminController@editStatusPeminjaman');
        Route::post('/updatePeminjaman', 'App\Http\Controllers\AdminController@updateStatusPeminjaman');
    });
});

