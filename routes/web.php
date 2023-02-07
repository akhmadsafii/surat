<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TemplateLetterController;
use App\Http\Controllers\UserController;
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
        });

        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('page');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('detail', [UserController::class, 'detail'])->name('detail');
        });

        Route::prefix('messages')->name('message.')->group(function () {
            Route::prefix('inbox')->name('inbox.')->group(function () {
                Route::get('/', [InboxController::class, 'inbox'])->name('page');
                Route::get('detail/{id}', [InboxController::class, 'detail'])->name('detail');
                Route::get('create', [InboxController::class, 'create'])->name('create');
                Route::post('save', [InboxController::class, 'store'])->name('store');
                Route::post('save-detail', [InboxController::class, 'save'])->name('save');
                Route::get('delete', [InboxController::class, 'delete'])->name('delete');
                Route::prefix('dispositions')->name('disposition.')->group(function () {
                    Route::get('message/{code}', [DispositionController::class, 'create'])->name('create');
                });
            });
            // Route::get('/', [MessageController::class, 'inbox'])->name('inbox');
            // Route::post('/', [MessageController::class, 'store'])->name('store');
        });

        Route::prefix('template-letters')->name('template_letter.')->group(function () {
            Route::get('/', [TemplateLetterController::class, 'index'])->name('page');
            Route::post('/', [TemplateLetterController::class, 'store'])->name('store');
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
