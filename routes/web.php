<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;


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


Route::view('/', 'welcome')->name('welcome');

Route::get('/admin', [AdminController::class, 'view'])->name('admin');


Route::middleware(Admin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'view'])->name('admin');
    Route::post('/create', [AdminController::class, 'createDoctor'])->name('createDoctor')->prefix('admin');
    Route::get('/deleteDoctor/{id}', [AdminController::class, 'deleteDoctor'])->name('deleteDoctor')->prefix('admin');
    Route::get('/updateDoctorView/{id}', [AdminController::class, 'viewUpdate'])->name('viewUpdate')->prefix('admin');
    Route::post('/updateDoctor/{id}', [AdminController::class, 'update'])->name('updateDoctor')->prefix('admin');
    Route::get('/records/{id}', [RecordController::class, 'viewAdminRecords'])->name('viewRecords')->prefix('admin');
    Route::post('/createRecord', [RecordController::class, 'createRecord'])->name('createRecord')->prefix('admin');
    Route::get('/deleteRecord/{id}', [RecordController::class, 'deleteRecord'])->name('deleteRecord')->prefix('admin');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    Route::get('/userRecord', [RecordController::class, 'viewUserRecords'])->name('viewUserRecords');
    Route::get('/chooseRecord/{user_id}/{id}', [RecordController::class, 'chooseRecord'])->name('chooseRecord');
    Route::get('/user/records/{id}', [RecordController::class, 'viewMyRecords'])->name('viewMyRecords');
    Route::get('/deleteRecord/{id}', [RecordController::class, 'deleteUserRecord'])->name('deleteUserRecord');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::view('/dashboard', 'user.dashboard')->name('dashboard');
});
