<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    // Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('verify', [AuthController::class, 'verify_login'])->name('verify_login');
    // Route::post('verify-register', [AuthController::class, 'verifyRegister'])->name('verify_register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::prefix('manages')->name('manage.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('page');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('detail', [AdminController::class, 'detail'])->name('detail');
            Route::get('delete', [AdminController::class, 'delete'])->name('delete');
        });
        Route::prefix('settings')->name('setting.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('page');
            Route::post('/', [SettingController::class, 'store'])->name('store');
            Route::get('reset', [SettingController::class, 'reset'])->name('reset');
        });

        Route::prefix('profiles')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'admin'])->name('page');
            Route::post('update', [ProfileController::class, 'update'])->name('update');
            Route::post('reset-password', [ProfileController::class, 'update_password'])->name('update_password');
        });

        Route::prefix('instructions')->name('instruction.')->group(function () {
            Route::get('/', [InstructionController::class, 'index'])->name('page');
            Route::post('/', [InstructionController::class, 'store'])->name('store');
            // Route::post('update', [ProfileController::class, 'update'])->name('update');
            // Route::post('reset-password', [ProfileController::class, 'update_password'])->name('update_password');
        });
    });
});

Route::prefix('users')->name('user.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'user'])->name('dashboard');

    // Route::prefix('admins')->name('admin.')->group(function () {
    //     Route::get('/', [AdminController::class, 'index'])->name('index');
    //     Route::post('/', [AdminController::class, 'store'])->name('store');
    //     Route::get('create', [AdminController::class, 'create'])->name('create');
    // });
})->middleware('auth:user');
