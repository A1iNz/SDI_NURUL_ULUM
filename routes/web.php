<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AbsensiController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('login', [AuthController::class,'index'])->name('login');
Route::post('proses_login', [AuthController::class,'proses_login'])->name('proses_login');

Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses_register');

Route::get('logout', [AuthController::class,'logout'])->name('logout');

Route::get('absensi', [AbsensiController::class,'index'])->name('absensi');
Route::get('pembayaran', [PembayaranController::class,'index'])->name('pembayaran');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);
    });
});
