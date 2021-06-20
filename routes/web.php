<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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

/*
|--------------------------------------------------------------------------
| Routes naming in this file follows rules in:
| https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
|--------------------------------------------------------------------------
*/


Auth::routes();

Route::get('/clear-cache', function () {
	Artisan::call('config:cache');
	Artisan::call('cache:clear');
	return redirect()->route('index');
});

/*
|--------------------------------------------------------------------------
| Index routes.
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('index', [HomeController::class, 'index'])->name('index');

/*
|--------------------------------------------------------------------------
| Administrator routes.
|--------------------------------------------------------------------------
*/
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

/*
|--------------------------------------------------------------------------
| Administrator routes.
|--------------------------------------------------------------------------
*/
Route::get('user/search', [UserController::class, 'search'])->name('user.search');
Route::get('user/{id}/response', [UserController::class, 'detail'])->name('user.detail.response');

/*
|--------------------------------------------------------------------------
| Paket routes.
|--------------------------------------------------------------------------
*/
Route::get('paket', [PaketController::class, 'index'])->name('paket.index');
Route::get('paket/create', [PaketController::class, 'create'])->name('paket.create');
Route::post('paket', [PaketController::class, 'store'])->name('paket.store');
Route::get('paket/{id}', [PaketController::class, 'detail'])->name('paket.detail');

Route::get('notifikasi', [PaketController::class, 'notifications'])->name('notifikasi');

/*
|--------------------------------------------------------------------------
| Penerimaan routes.
|--------------------------------------------------------------------------
*/
Route::post('penerimaan', [PenerimaanController::class, 'store'])->name('penerimaan.store');

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
});
