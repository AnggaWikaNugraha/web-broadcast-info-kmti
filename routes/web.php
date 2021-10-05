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
use App\Models\Divisi;
use App\Models\Event;

// landing page
Route::get('/', function () { 

    $eventsActive = Event::where([
        ['status', '=', 'belum-mulai'],
    ])
    ->orderBy('tanggal', 'DESC')
    ->get();

    $divisi = Divisi::where('keterangan', 'Divisi KMTI')->get();

    return view('welcome', compact(
        'eventsActive',
        'divisi'
    ));
});

Route::get('/event/{id}', function ($id) {
    $event = Event::findOrFail($id);
    return view('event', compact('event'));

})->name('event.detail');

Route::get('/divisi/{id}', function ($id) {
    $divisi = Divisi::findOrFail($id);
    return view('divisi', compact('divisi'));

})->name('divisi.detail');


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
Route::get('ajax/admin/divisi/search', [InfoController::class, 'searchDivisi'])->name('admin.search.divisi');

// mahasiswa
Route::get('/user/dashboard', [UserMahasiswaController::class, 'index'])->name('user.dashboard');

Route::get('/user/divisi', [UserMahasiswaController::class, 'divisi'])->name('user.divisi');
Route::get('/user/divisi/{id}', [UserMahasiswaController::class, 'detailDivisi'])->name('user.detailDivisi');
Route::get('ajax/user/divisi/search', [UserMahasiswaController::class, 'searchDivisi'])->name('user.search.divisi');


Route::get('/user/event', [UserMahasiswaController::class, 'event'])->name('user.event');
Route::get('/user/event/{id}', [UserMahasiswaController::class, 'detailEvent'])->name('user.detailEvent');

Route::get('/user/profile', [UserMahasiswaController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [UserMahasiswaController::class, 'edit'])->name('user.profile.edit');
Route::patch('/user/profile/{id}/saveedit', [UserMahasiswaController::class, 'saveedit'])->name('user.profile.saveedit');
Route::get('/user/profile/compliting', [UserMahasiswaController::class, 'compliting'])->name('user.profile.compliting');
Route::patch('/user/profile/{id}/savecompliting', [UserMahasiswaController::class, 'savecompliting'])->name('user.profile.savecompliting');
Route::get('/user/info', [UserMahasiswaController::class, 'info'])->name('user.info');
Route::get('/user/info/{id}/detail', [UserMahasiswaController::class, 'infoDetail'])->name('user.infoDetail');
Route::patch('/user/info/{id}/detail', [UserMahasiswaController::class, 'infoRead'])->name('user.infoRead');