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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('admin/users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');
 Route::resource('admin/pelanggan', \App\Http\Controllers\PelangganController::class)
    ->middleware('auth');;
 Route::resource('admin/gitar', \App\Http\Controllers\GitarController::class)
    ->middleware('auth');;
    Route::resource('admin/pemesanan', \App\Http\Controllers\PemesananController::class)
    ->middleware('auth');

    // Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::get('user/search', [App\Http\Controllers\UserController::class, 'search'])->name('user/search');
    // Route::resource('/pemesanan', App\Http\Controllers\PemesananController::class);
    Route::get('pesan/search', [App\Http\Controllers\PemesananController::class, 'search'])->name('pesan/search');
   
    // Route::resource('/pelanggan', App\Http\Controllers\PelangganController::class);
    Route::get('plgn/search', [App\Http\Controllers\PelangganController::class, 'search'])->name('plgn/search');
    // Route::resource('/gitar', App\Http\Controllers\GitarController::class);
    Route::get('gtr/search', [App\Http\Controllers\GitarController::class, 'search'])->name('gtr/search');
