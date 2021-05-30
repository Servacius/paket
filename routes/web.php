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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('petugas/home', [App\Http\Controllers\HomeController::class, 'petugasHome'])->name('petugas.home')->middleware('is_petugas');
Route::get('karyawan/home', [App\Http\Controllers\HomeController::class, 'karyawanHome'])->name('karyawan.home')->middleware('is_karyawan');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('autocomplete', [App\Http\Controllers\UserController::class, 'autocomplete'])->name('autocomplete');

	// Petugas
	Route::get('tambah-barang', ['as' => 'petugas.addBarang', 'uses' => 'App\Http\Controllers\PetugasController@add']);
	Route::put('tambah-barang', ['as' => 'petugas.addBarang', 'uses' => 'App\Http\Controllers\PetugasController@addBarang']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

