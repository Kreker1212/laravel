<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

Route::view('/', 'welcome')->name('welcome');

Route::get('/admin', [AdminController::class, 'view'])->name('admin');

Route::middleware(Admin::class)->prefix('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'view'])->name('admin');
    Route::post('/admin', [AdminController::class, 'createDoctor'])->name('doctor.create');
    Route::delete('/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('doctor.delete');
    Route::get('/doctors/{id}', [AdminController::class, 'viewUpdate'])->name('doctor.update.view');
    Route::put('/doctors/{id}', [AdminController::class, 'update'])->name('doctor.update');
    Route::get('/records/{id}', [RecordController::class, 'viewAdminRecords'])->name('view.records');
    Route::post('/records/{id}', [RecordController::class, 'createRecord'])->name('record.create');
    Route::delete('/records/{id}', [RecordController::class, 'deleteRecord'])->name('record.delete');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/records', [RecordController::class, 'viewUserRecords'])->name('view.records.user');
    Route::get('/records/{userId}/{id}', [RecordController::class, 'chooseRecord'])->name('record.choose');
    Route::get('/records/{id}', [RecordController::class, 'viewMyRecords'])->name('view.my.records');
    Route::delete('/records/{id}', [RecordController::class, 'deleteUserRecord'])->name('record.delete.user');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::view('/dashboard', 'user.dashboard')->name('dashboard');
});
