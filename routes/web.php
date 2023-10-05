<?php

//use App\Http\Controllers\MyPlaceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\RecordController;
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


Route::view('/', 'welcome')->name('welcome');

Route::get('/admin', [AdminController::class, 'view'])->name('admin');

Route::post('/admin/create', [AdminController::class, 'createDoctor'])->name('createDoctor');
Route::get('/admin/deleteDoctor/{id}', [AdminController::class, 'deleteDoctor'])->name('deleteDoctor');
Route::get('/admin/updateDoctorView/{id}', [AdminController::class, 'viewUpdate'])->name('viewUpdate');
Route::post('/admin/updateDoctor', [AdminController::class, 'update'])->name('updateDoctor');
Route::get('/admin/records/{id}', [RecordController::class, 'viewAdminRecords'])->name('viewRecords');
Route::post('/admin/createRecord', [RecordController::class, 'createRecord'])->name('createRecord');
Route::get('/admin/deleteRecord/{id}', [RecordController::class, 'deleteRecord'])->name('deleteRecord');
Route::get('/userRecord', [RecordController::class, 'viewUserRecords'])->name('viewUserRecords');
Route::get('/сhooseRecord/{user_id}/{id}', [RecordController::class, 'сhooseRecord'])->name('сhooseRecord');
Route::get('/user/records/{id}', [RecordController::class, 'viewMyRecords'])->name('viewMyRecords');
Route::get('/deleteRecord/{id}', [RecordController::class, 'deleteUserRecord'])->name('deleteUserRecord');



Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(callback: function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/appointment', [AppointmentController::class, 'read'])->name('appointment');
});
