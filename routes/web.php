<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;

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
    return view('login');
})->name('login');


Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::post('karyawan/add', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('karyawan/edit/{nip}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('karyawan/update/{nip}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('karyawan/delete/{nip}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
Route::get('karyawan/tambah-data', [KaryawanController::class, 'create'])->name('karyawan.create');

Route::get('json', [KaryawanController::class, 'json'])->name('json');
Route::post('search', [KaryawanController::class, 'search'])->name('search');