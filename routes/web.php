<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\User\MahasiswaController as UserMahasiswaController;

Route::get('/', function () { return view('welcome');});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// admin dan superadmin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('show-change-password');
Route::patch('/change-password/{id}', [AdminController::class, 'ChangePassword'])->name('change-password');

Route::resource('admin/manage-users', UserController::class);
Route::resource('admin/manage-event', EventController::class);
Route::resource('admin/manage-divisi', DivisiController::class);
Route::resource('admin/manage-info', InfoController::class);

// mahasiswa
Route::get('/user/dashboard', [UserMahasiswaController::class, 'index'])->name('user.dashboard');
Route::get('/user/divisi', [UserMahasiswaController::class, 'divisi'])->name('user.divisi');
Route::get('/user/event', [UserMahasiswaController::class, 'event'])->name('user.event');
Route::get('/user/profile', [UserMahasiswaController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [UserMahasiswaController::class, 'edit'])->name('user.profile.edit');
Route::patch('/user/profile/{id}/saveedit', [UserMahasiswaController::class, 'saveedit'])->name('user.profile.saveedit');
Route::get('/user/profile/compliting', [UserMahasiswaController::class, 'compliting'])->name('user.profile.compliting');
Route::patch('/user/profile/{id}/savecompliting', [UserMahasiswaController::class, 'savecompliting'])->name('user.profile.savecompliting');