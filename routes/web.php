<?php

use App\Http\Controllers\ProfileController;
// import permissionController
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::prefix('administrator') merupakan awalan untuk semua route digrup, semua route akan dimulai dengan '/administrator/blablabla' pada url
// namespace('App\Http\Controllers') controller yang digunakan berada dalam namespace 'App\Http\Controllers'
// menerapkan middleware(['auth']) pada route digrup, untuk memeriksa user sudah login atau belum
Route::prefix('administrator')->namespace('App\Http\Controllers')->middleware(['auth'])->group(function() {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('department', DepartmentController::class);
});

require __DIR__.'/auth.php';