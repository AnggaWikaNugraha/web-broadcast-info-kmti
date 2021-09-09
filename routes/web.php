<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\EventController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('show-change-password');
Route::patch('/change-password/{id}', [AdminController::class, 'ChangePassword'])->name('change-password');

Route::resource('admin/manage-users', UserController::class);
Route::resource('admin/manage-mahasiswa', MahasiswaController::class);
Route::resource('admin/manage-event', EventController::class);

Route::get('/ajax/users/search', [MahasiswaController::class, 'ajaxSearch']);
