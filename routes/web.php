<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Capsule\Manager;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//Admin Route
Route::middleware(['auth','admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
    });
});
//End admin Route


//Manager Route
Route::middleware(['auth','manager'])->group(function () {
    Route::controller(ManagerController::class)->group(function () {
        Route::get('manager/dashboard', 'ManagerDashboard')->name('manager.dashboard');
    });
});

//End Manager Route



