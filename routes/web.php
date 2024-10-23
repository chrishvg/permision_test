<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AssignController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/noallowed', [DashboardController::class, 'noallowed'])->name('noallowed');

Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('user');
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::get('/user/{id}/enabled', [UserController::class, 'enabled'])->name('user.enabled');
Route::put('/user', [UserController::class, 'update'])->name('user.update');
Route::delete('/user', [UserController::class, 'destroy']);

Route::get('/permission', [PermissionController::class, 'index'])->middleware(['auth', 'verified'])->name('permission');
Route::get('/assign', [AssignController::class, 'index'])->middleware(['auth', 'verified'])->name('assign');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
