<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::get('home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Administrator routes.
|--------------------------------------------------------------------------
*/
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

/*
|--------------------------------------------------------------------------
| Petugas routes.
|--------------------------------------------------------------------------
*/
Route::get('petugas/home', [HomeController::class, 'petugasHome'])->name('petugas.home')->middleware('is_petugas');

/*
|--------------------------------------------------------------------------
| Karyawan routes.
|--------------------------------------------------------------------------
*/
Route::get('karyawan/home', [KaryawanController::class, 'index'])->name('karyawan.home');

/*
|--------------------------------------------------------------------------
| General auth routes.
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
	Route::resource('user', UserController::class)->except(['show']);

	Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');

	Route::get('autocomplete', [UserController::class, 'autocomplete'])->name('autocomplete');

	Route::get('tambah-barang', [PetugasController::class, 'add'])->name('petugas.addBarang');
	Route::put('tambah-barang', [PetugasController::class, 'addBarang'])->name('petugas.addBarang');

	Route::get('{page}', [PageController::class, 'index'])->name('page.index');
});
